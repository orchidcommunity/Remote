<?php

namespace Orchid\Remote\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\Http\Controllers\Controller;

class RemoteAdminController extends Controller
{

    /**
     * @param         $service
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($service, Request $request)
    {
        $response = $service->send('', 'GET', $request->except('_token'));
        $response['service'] = $service->service;

        return view('remote::main', $response);
    }

    /**
     * @param         $service
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($service, Request $request)
    {
        $response = $service->send('create', 'GET', $request->except('_token'));
        $response['service'] = $service->service;



        return view('remote::create', $response);
    }

    /**
     * @param         $service
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store($service, Request $request)
    {
        $response = $service->send('', 'POST', $request->except('_token'));
        $service = $service->service;

        return redirect()->route('dashboard.remote.{remote}.store', $service['service']. '-'. $service['route']);
    }



    /**
     * @param $service
     * @param $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($service, $slug, Request $request)
    {
        $response = $service->send($slug . '/edit', 'GET', $request->except('_token'));
        $response['service'] = $service->service;


        return view('remote::edit', $response);
    }

    /**
     * @param         $service
     * @param         $slug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($service, $slug, Request $request)
    {
        $service->send($slug, 'PUT', $request->except('_token'));
        $service = $service->service;

        return redirect()->route('dashboard.remote.{remote}.store', $service['service']. '-'. $service['route']);

    }


    /**
     * @param $service
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($service, $slug)
    {
        $service->send($slug, 'DELETE');

        $service = $service->service;

        return redirect()->route('dashboard.remote.{remote}.store', $service['service']. '-'. $service['route']);

    }


}
