<?php

namespace Evently\LimeRemote;

use Illuminate\Support\ServiceProvider;

class LimeRemoteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/limeremote.php', 'limeremote');

        $this->app->singleton('limeremote', function ($app) {
            $config = $app['config']->get('limeremote', []);

            return new LimeRemote(
                $config['username'] ?? null,
                $config['password'] ?? null,
                $config['url'] ?? null,
                $config['survey_id'] ?? null,
                $config['debug'] ?? false
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/limeremote.php' => config_path('limeremote.php'),
        ], 'config');
    }
}
