<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Pusher, Ltd (https://pusher.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pusher\Chatkit\Laravel;

use Chatkit\Chatkit;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the Pusher service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ChatkitServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $configFile = realpath(__DIR__.'/../config/chatkit.php');
        $this->publishes([
            $configFile => config_path('chatkit.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/chatkit.php'), 'chatkit');
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('chatkit.factory', function () {
            return new ChatkitFactory();
        });

        $this->app->alias('chatkit.factory', ChatkitFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('chatkit', function (Container $app) {
            $config = $app['config'];
            $factory = $app['chatkit.factory'];
            return new ChatkitManager($config, $factory);
        });

        $this->app->alias('chatkit', ChatkitManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('chatkit.connection', function (Container $app) {
            $manager = $app['chatkit'];

            return $manager->connection();
        });

        $this->app->alias('chatkit.connection', Chatkit::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'chatkit',
            'chatkit.factory',
            'chatkit.connection',
        ];
    }
}
