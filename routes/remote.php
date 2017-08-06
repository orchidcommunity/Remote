<?php

/*
|--------------------------------------------------------------------------
| Post API Routes
|--------------------------------------------------------------------------
|
| Base route
|
*/

$this->group([
    'middleware' => ['web', 'dashboard', 'access'],
    'prefix'     => 'dashboard/remote',
    'namespace'  => 'Orchid\Remote\Http\Controllers',
], function ($router) {

    //$router->resource('/{remote}', 'RemoteAdminController', [
    //    'as' => 'dashboard.remote',
    //]);

    $router->get('/{remote}', [
        'as'   => 'dashboard.remote.{remote}.index',
        'uses' => 'RemoteAdminController@index',
    ]);
    $router->post('/{remote}', [
        'as'   => 'dashboard.remote.{remote}.store',
        'uses' => 'RemoteAdminController@store',
    ]);
    $router->get('/{remote}/create', [
        'as'   => 'dashboard.remote.{remote}.create',
        'uses' => 'RemoteAdminController@create',
    ]);
    $router->get('/{remote}/{remote_slug}/edit', [
        'as'   => 'dashboard.remote.{remote}.edit',
        'uses' => 'RemoteAdminController@edit',
    ]);
    $router->put('/{remote}/{remote_slug}', [
        'as'   => 'dashboard.remote.{remote}.update',
        'uses' => 'RemoteAdminController@update',
    ]);
    $router->delete('/{remote}/{remote_slug}', [
        'as'   => 'dashboard.remote.{remote}.destroy',
        'uses' => 'RemoteAdminController@destroy',
    ]);
});
