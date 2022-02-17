<?php

namespace App\Providers;

use App\Http\Services\Currency\FixerDataProvider;
use Illuminate\Support\ServiceProvider;

class CurrencyDataProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FixerDataProvider::class, static function($app) {
            $apiKey = env('FIXER_API_KEY', '');
            return new FixerDataProvider($apiKey);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
