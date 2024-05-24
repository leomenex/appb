<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BallotCConfig;
use App\Models\BallotCServer;
use App\Models\BallotCValue;
use App\Models\User;
use App\Services\Migrators\BallotCMigratorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closure;

class BallotCController extends Controller
{
    public function __construct(private BallotCMigratorService $service)
    {
    }

    public function import(Request $request): Response
    {
        $request->validate([
            'file' => ['file', 'max:10000'],
            'reference_year' => [
                'required',
                'numeric',
                'max:' . (now()->year - 1),
                'min:' . (now()->subYears(20)->year - 1),
                function (string $key, string|null $value, Closure $fail) use ($request) {
                    if ($request->has('force') && $request->force) {
                        return true;
                    }

                    $models = ['BallotCInfo', 'BallotCValue', 'BallotCServer', 'BallotCConfig'];

                    foreach ($models as $model) {
                        $model = "App\\Models\\" . $model;

                        if ($model::where('reference_year', $value)->exists()) {
                            $fail("Já existem registros para o ano $value");
                        }
                    }
                }
            ]
        ]);

        $this->service->import($request->all(), true);

        return response()->noContent();
    }

    public function pdf(string $cpf)
    {
        $server = BallotCServer::firstWhere('cpf', $cpf);
        $config = BallotCConfig::firstWhere('name', 'DECPJ');

        $formatNumber = fn (float $n) => number_format((float) $n, 2, ',', '.');

        $values = [];
        $ballotCValues = BallotCValue::selectRaw("count(id), name, sum(value) as total")
            ->groupBy('name')
            ->where('cpf', $cpf)
            ->where('month', '<', 13)
            ->get()
            ->each(function ($item) use (&$values, $formatNumber) {
                $values[$item->name] = $formatNumber((float) $item->total);
            });

        // décimo terceiro
        $thirteenth = [];
        $thirteenth['base'] = 0.0;
        $thirteenth['discont'] = 0.0;
        BallotCValue::where('month', 13)->where('cpf', $cpf)->get()
            ->each(function ($item) use (&$thirteenth, $formatNumber) {
                $formatted = $formatNumber((float) $item->value ?? 0.0);

                $thirteenth[$item->name] = $formatted;

                if ($item->name == 'RTRT') {
                    $thirteenth['base'] = $formatted;
                } else {
                    // $thirteenth['discont'] += $formatted;
                }
            });

        // dd($values, $thirteenth);

        $nature = $server->idrec === '0561'
            ? "Rendimento do trabalhador assalariado"
            : "Rendimento do trabalhador sem vinculo empregatício";

        return view('pdf.ballotc', compact('server', 'config', 'nature', 'values'));
    }
}
