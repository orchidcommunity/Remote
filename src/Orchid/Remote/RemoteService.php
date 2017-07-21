<?php

namespace Orchid\Remote;

use GuzzleHttp\Client;

class RemoteService
{

    /**
     * @var
     */
    public $service;

    /**
     * @param $service
     * @param $route
     *
     * @return $this
     * @throws \Exception
     */
    public function registration($service, $route)
    {
        $this->service = config('services.integrator.' . $service, false);

        if ($this->service === false) {
            throw new \Exception('Service not found');
        }

        $this->service['route'] = $route;
        $this->service['service'] = $service;

        return $this;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array  $query
     *
     * @return mixed
     */
    public function send($path = '', $method = 'GET', $query = [])
    {
        $path = '/' . $path;

        $client = new Client([
            'timeout' => 3.0,
        ]);

        $url = $this->service['url'] . '/integrator/' . $this->service['route'] . $path;

        $response = $client->request($method, $url, [
            'query' => $query,
        ]);
        $response = $response->getBody()->getContents();

        return json_decode($response, true);
    }


    /**
     * @param $fields
     * @param $data
     *
     * @return string
     */
    public static function generateForm($fields, $data)
    {
        $form = '';
        foreach ($fields as $field => $config) {

            $config['lang'] = app()->getLocale();
            $config['value'] = collect($data)->get($field);
            $config = collect($config);

            $field = config('content.fields.' . $config['tag']);

            if (is_null($field)) {
                throw new TypeException('Field ' . $config['tag'] . ' does not exist');
            }

            $field = new $field();
            $field = $field->create($config);
            $form .= $field->render();
        }

        return $form;
    }

}
