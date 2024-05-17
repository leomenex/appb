<?php

namespace App\Services\Migrators;

use App\Models\BallotCConfig;
use App\Models\BallotCInfo;
use App\Models\BallotCServer;
use App\Models\BallotCValue;

class BallotCMigratorService
{
    private function csv2array(array|string $csv = [],  string $delimiter = '|')
    {
        return str_getcsv($csv, $delimiter);
    }

    public function import(array $data, ?bool $truncate = false): void
    {
        $content = array_map(array($this, 'csv2array'), file($data['file']));

        if ($truncate) {
            BallotCInfo::truncate();
            BallotCValue::truncate();
            BallotCServer::truncate();
            BallotCConfig::truncate();
        }

        foreach ($content as $item) {

            $this->createData($item, $data['reference_year']);
        }
    }

    private function createData(array $item, int $reference_year): void
    {
        $cpf = "";
        $name = "";
        $idrec = "";
        switch ($item[0]) {
            case 'IDREC':
                $idrec = $item[1];
                break;

            case 'BPFDEC':
                $cpf = $item[1];
                $name = $item[2];
                BallotCServer::create([
                    'name' => $name,
                    'cpf' => $cpf,
                    'idrec' => $idrec,
                    'reference_year' => $reference_year
                ]);

                break;
            case 'RESPO':
                BallotCConfig::create([
                    'name' => $item[0],
                    'font' => $item[2],
                    'doc' => $item[1],
                    'email' => $item[7],
                    'reference_year' => $reference_year
                ]);
                break;
            case 'DECPJ':
                BallotCConfig::create([
                    'name' => $item[0],
                    'font' => $item[2],
                    'doc' => $item[1],
                    'reference_year' => $reference_year
                ]);
                break;
            case 'INF':

                BallotCInfo::create([
                    'cpf' => $item[1],
                    'text' => $item[2],
                    'reference_year' => $reference_year
                ]);
                break;

            default:
                foreach ($item as $i => $value) {
                    if ($i == 0 || $i >= 13 || !is_numeric($value)) {
                        continue;
                    }

                    $value = $value == '' ? 0 : $value;

                    $formatted = substr($value, 0, -2) . "." . substr($value, -2);

                    BallotCValue::create([
                        'cpf' => $cpf,
                        'name' => $item[0],
                        'value' => $formatted,
                        'month' => $i,
                        'reference_year' => $reference_year
                    ]);
                }
                break;
        }
    }
}
