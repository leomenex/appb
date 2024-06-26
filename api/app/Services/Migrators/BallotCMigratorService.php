<?php

namespace App\Services\Migrators;

use App\Models\BallotCConfig;
use App\Models\BallotCInfo;
use App\Models\BallotCServer;
use App\Models\BallotCValue;

class BallotCMigratorService
{
    private string $cpf = '';
    private string $idrec = '';

    public function import(array $data, ?bool $truncate = false): void
    {
        $content = array_map(array($this, 'csv2array'), file($data['file']));

        if ($truncate) {
            BallotCInfo::truncate();
            BallotCValue::truncate();
            BallotCServer::truncate();
            BallotCConfig::truncate();
        }

        if (isset($data['limit']) && !empty($data['limit'])) {
            $newContent = [];
            $skiped = 0;
            foreach ($content as $key => $item) {
                if (in_array($item[0], ['RESPO', 'DECPJ'])) {
                    $skiped++;
                    continue;
                }

                if ($key <= ($data['limit'] + $skiped)) {
                    $newContent[] = $item;
                }
            }

            $content = $newContent;
        }

        foreach ($content as $item) {

            $this->createData($item, $data['reference_year']);
        }
    }

    private function csv2array(array|string $csv = [],  string $delimiter = '|')
    {
        return str_getcsv($csv, $delimiter);
    }

    private function createData(array $item, int $reference_year): void
    {
        switch ($item[0]) {
            case 'BPFDEC':
                $this->cpf = $item[1];
                BallotCServer::create([
                    'name' => $item[2],
                    'cpf' => $this->cpf,
                    'idrec' => $this->idrec,
                    'reference_year' => $reference_year
                ]);
                break;

            case 'DIRF':
                //echo "salva na tabela INF - " . $dados[1] . " - " . $dados[2] . "<br>";
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

            case 'IDREC':
                $this->idrec = $item[1];
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
                    if ($i == 0 || $i >= 14 || !is_numeric($value)) {
                        continue;
                    }

                    $value = $value == '' ? 0 : $value;

                    $formatted = substr($value, 0, -2) . "." . substr($value, -2);

                    BallotCValue::create([
                        'cpf' => $this->cpf,
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
