<?php


namespace Cabard\Nimda;

use Illuminate\Auth\RequestGuard;
use Cabard\Nimda\Extensions\AdminProvider;
use Cabard\Nimda\Services\Auth\NimdaGuard;
use Illuminate\Support\Facades\Auth;
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
        //добавление в конфиг гварда(охранника)
        config([
            'auth.guards.nimda' => array_merge([
                'driver' => 'session',
//                'driver' => 'nimda', //TODO
                'provider' => 'nimda',
            ], config('auth.guards.nimda', [])),
        ]);
        //добавление в конфиг провайдера
        config([
            'auth.providers.nimda' => array_merge([
                'driver' => 'eloquent',
                'model' => \Cabard\Nimda\Models\Admin::class,
            ], config('auth.providers.nimda', [])),
        ]);

        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/nimda.php', 'nimda');
        }
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/nimda.php' => config_path('nimda.php'),
            ], 'config');
        }

        $this->configureGuard();
    }

    /**
     * Регистрация службы аутентификации / авторизации для nimda.
     *
     * @return void
     */
    protected function configureGuard()
    {
        //регистрация кастомного охранника
        Auth::resolved(function ($auth) {
            $auth->extend('nimda', function ($app, $name, array $config) use ($auth) {
                return new NimdaGuard(Auth::createUserProvider($config['provider']), request());
            });

            $auth->provider('nimda', function ($app, array $config) {
                return new AdminProvider($app->make($config['model']));
            });
        });
    }
}
