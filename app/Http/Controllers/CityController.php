<?php

namespace App\Http\Controllers;

use App\Helpers\GuzzleHelper;

class CityController extends Controller
{
    private $baseUrl = 'http://backend-dev.cakra-tech.co.id/api';

    public function index()
    {
        $response = GuzzleHelper::request('GET', "$this->baseUrl/city");
        $citys = json_decode($response);
        return view('management.city.index', compact('citys'));
    }
}
