<?php

use App\Http\Controllers\Auth\AuthenticatedTokenController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(404, 'Not Found');
});

Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->name('news.')->prefix('noticias')->group(function () {
        Route::get('', [NewsController::class, 'index'])->name('index');
        Route::get('{news}', [NewsController::class, 'show'])->name('show');
    });

    require __DIR__ . '/api_auth.php';
});
