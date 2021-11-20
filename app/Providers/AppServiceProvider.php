<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\v1\Auth\AuthRepositoryInterface',
            'App\Repositories\v1\Auth\AuthRepository',
        );
        $this->app->bind(
            'App\Repositories\v1\Product\ProductRepositoryInterface',
            'App\Repositories\v1\Product\ProductRepository'
        );
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
