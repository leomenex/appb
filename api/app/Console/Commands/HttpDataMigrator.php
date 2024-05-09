<?php

namespace App\Console\Commands;

use App\Enums\StatusMigrator;
use App\Services\Migrators\NewsMigratorService;
use Illuminate\Console\Command;

class HttpDataMigrator extends Command
{
    private array $services = [
        NewsMigratorService::class
    ];

    private string $currentClass = '';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'http:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa dados de fontes externas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            foreach ($this->services as $service) {
                $this->currentClass = $service;

                (new $service)->import();
            }
        } catch (\Throwable $th) {

            $this->error($th->getMessage());

            register_migration_logs(
                class: $this->currentClass,
                line: __LINE__,
                status: StatusMigrator::FAIL,
                message: $th->getMessage(),
                trace: json_encode($th->getTrace())
            );
        }
    }
}
