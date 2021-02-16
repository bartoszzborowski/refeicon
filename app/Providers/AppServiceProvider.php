<?php

namespace App\Providers;

use App\Library\Services\Exchange\NBPExchangeService;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(NBPExchangeService::class, function($app) {
            return new NBPExchangeService(config('services.nbp_exchange.url'));
        });
    }
}
