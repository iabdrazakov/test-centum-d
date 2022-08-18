<?php

namespace App\Providers;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Infrastructure\RedisUrlRepository;
use App\Services\Repositories\UrlRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UrlRepository::class => RedisUrlRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
