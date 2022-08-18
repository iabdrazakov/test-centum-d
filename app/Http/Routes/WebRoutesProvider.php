<?php

namespace App\Http\Routes;

use App\Http\Controllers\StoreUrlController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowUrlController;
use Illuminate\Support\Facades\Route;

final class WebRoutesProvider
{
    public function register(): void
    {
        Route::get(
            '/',
            HomeController::class
        )->name(WebRoutes::HOME);
        Route::post(
            '/',
            StoreUrlController::class,
        )->name(WebRoutes::URLS_STORE);
        Route::get(
            '{hash}',
            ShowUrlController::class,
        )->name(WebRoutes::URLS_SHOW);
    }
}
