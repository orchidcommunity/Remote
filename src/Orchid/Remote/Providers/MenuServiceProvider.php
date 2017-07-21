<?php

namespace Orchid\Remote\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Orchid\Remote\Http\Composers\RemoteComposer;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * @internal param Dashboard $dashboard
     */
    public function boot()
    {
        View::composer('dashboard::layouts.dashboard', RemoteComposer::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
