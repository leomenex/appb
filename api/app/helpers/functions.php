<?php

use App\Enums\StatusMigrator;
use App\Models\HttpMigrationLog;

if (!function_exists('register_migration_logs')) {
    function register_migration_logs(
        string $class,
        int $line,
        StatusMigrator $status,
        ?string $url = '',
        ?string $message = '',
        ?string $trace = '',
    ): void {

        HttpMigrationLog::create([
            'class' => $class,
            'line'=> $line,
            'url'=> $url,
            'status' => $status,
            'message' => $message,
            'trace' => $trace,
        ]);
    }
}
