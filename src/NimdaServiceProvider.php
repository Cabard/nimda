<?php


namespace Cabard\Nimda;

use Illuminate\Support\ServiceProvider;

/**
 * Class NimdaServiceProvider. Установщик пакета для Laravel
 * @package Cabard\Netbot
 */
class NimdaServiceProvider extends ServiceProvider
{
    /**
     * Загрузка любых служб пакета.
     *
     * @return void
     */
    public function register()
    {
        dd(1);
        config([
            'auth.guards.nimda' => array_merge([
                'driver' => 'nimda',
                'provider' => null,
            ], config('auth.guards.nimda', [])),
        ]);

        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/nimda.php', 'nimda');
        }
    }

    public function boot()
    {
        dd(2);
//        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/nimda.php' => config_path('nimda.php'),
            ], 'config');
        }
    }
}
