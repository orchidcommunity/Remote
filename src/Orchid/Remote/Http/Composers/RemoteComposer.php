<?php

namespace Orchid\Remote\Http\Composers;

use Orchid\Kernel\Dashboard;

class RemoteComposer
{
    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items
     */
    public function compose()
    {
        $this->registerMenuRemote($this->dashboard);
    }

    /**
     * @param Dashboard $dashboard
     */
    protected function registerMenuRemote(Dashboard $dashboard)
    {
        $client = new \GuzzleHttp\Client([
            'timeout' => 3.0,
        ]);

        foreach (config('services.integrator') as $key => $value) {

            $dashboard->menu->add('Main', [
                'slug'   => str_slug($value['name']),
                'icon'   => $value['icon'],
                'route'  => '#',
                'label'  => $value['name'],
                'childs' => true,
                'main'   => true,
                'active' => 'dashboard.remote' . str_slug($value['name']) . '.*',
                //'permission' => 'dashboard.tools',
                'sort'   => 10,
            ]);

            $response = $client->request('GET', $value['url'] . '/integrator');
            $response = $response->getBody()->getContents();
            $response = json_decode($response, true);

            foreach ($response as $item) {

                $dashboard->menu->add(str_slug($value['name']), [
                    'slug'   => str_slug($item['route']),
                    'icon'   => $item['icon'],
                    'route'  => route('dashboard.remote.{remote}.index', $key. '-'. $item['route']),
                    'label'  => $item['name'],
                    'childs' => false,
                    'main'   => false,
                    'active' => 'dashboard.remote.'.$key .'.*',
                    //'permission' => 'dashboard.posts',
                    'sort'   => 10,
                ]);
            }

        }


    }
}
