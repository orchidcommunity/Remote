<?php

namespace Orchid\Remote\Providers;

use Illuminate\Support\ServiceProvider;

class RemoteServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot()
    {
        $this->registerProviders();

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/vendor/orchid/dashboard';
        }, config('view.paths')), [
            __DIR__ . '/../../../../resources/views',
        ]), 'remote');

        $this->registerProviders();

    }

    /**
     * registerProviders
     */
    public function registerProviders()
    {
        foreach ($this->provides() as $provide) {
            $this->app->register($provide);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            RouteServiceProvider::class,
            MenuServiceProvider::class
        ];
    }

}
