<?php

use App\Http\Controllers\Api\BallotCController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(404, 'Not Found');
});

Route::prefix('v1')->group(function () {

    // Route::middleware('auth:sanctum')->group(function () {

        Route::name('news.')->prefix('noticias')->group(function () {
            Route::get('', [NewsController::class, 'index'])->name('index');
            Route::get('{news}', [NewsController::class, 'show'])->name('show');
        });

        Route::name('ballotc.')->prefix('cedulac')->group(function () {
            Route::post('import', [BallotCController::class, 'import'])->name('import');
            Route::get('{cpf}/pdf', [BallotCController::class, 'pdf'])->name('pdf');
        });
    // });

    require __DIR__ . '/api_auth.php';
});
