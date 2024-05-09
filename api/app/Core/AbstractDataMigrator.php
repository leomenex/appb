<?php

namespace App\Core;

use App\Enums\AppExternal;
use App\Enums\StatusMigrator;
use App\Services\Migrators\NewsMigratorService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

abstract class AbstractDataMigrator
{
    protected AppExternal $appExternal;

    /**
     * requisicao http
     * @return array dados da requisicao
     */
    protected function execute(
        string $method,
        string $endpoint,
        ?array $params = [],
        ?array $headers = []
    ): array {
        $url = "{$this->appExternal->getBaseURL()}/$endpoint";
        $method = strtolower($method);

        $response = Http::withHeaders($headers)->$method($url, $this->prepareParams($params));

        $status = $response->failed() ? StatusMigrator::FAIL : StatusMigrator::SUCCESS;

        register_migration_logs(
            class: get_called_class(),
            line: __LINE__,
            status: $status,
            message: "Migracao de dados",
            url: $url,
            trace: $status === StatusMigrator::SUCCESS ? '' :  $response->body(),
        );

        return $this->prepareBodyData($response->json());
    }

    /** script to migrate data */
    protected function import(): void
    {
    }

    protected function prepareParams(array $params): array
    {
        if (
            App::runningUnitTests()
            || !in_array(App::environment('APP_ENV'), ['production', 'prod'])
        ) {
            if (get_called_class() instanceof NewsMigratorService) {
                $params['categoria_nome'] = 'ame';
            }
        }

        return $params;
    }

    protected function prepareBodyData(array $data): array
    {
        if (
            App::runningUnitTests()
            || !in_array(App::environment('APP_ENV'), ['production', 'prod'])
        ) {
            if (get_called_class() instanceof NewsMigratorService) {
                $data['noticias'] = $data['noticias']['data'];
            }
        }

        return $data;
    }
}
