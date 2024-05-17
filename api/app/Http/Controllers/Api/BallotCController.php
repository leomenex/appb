<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
                function (string $key, string|null $value, Closure $fail) {
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

        $this->service->import($request->all());

        return response()->noContent();
    }
}
