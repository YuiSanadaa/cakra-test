<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GuzzleHelper
{
    public static function request($method, $url, $options = [], $route = null)
    {
        if (!$route == null) {
            $headers = [
                'Accept' => 'application/json',
            ];
        } else {
            $token = Session::get('jwt_token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ];
        }
        if (isset($options['json'])) {
            $headers['Content-Type'] = 'application/json';
        }

        $client = new Client([
            'headers' => $headers,
        ]);

        $response = $client->request($method, $url, $options);

        return $response->getBody()->getContents();
    }
}
