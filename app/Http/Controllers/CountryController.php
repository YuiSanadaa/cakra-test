<?php

namespace App\Http\Controllers;

use App\Helpers\GuzzleHelper;

class CountryController extends Controller
{
    private $baseUrl = 'http://backend-dev.cakra-tech.co.id/api';

    public function index()
    {
        $response = GuzzleHelper::request('GET', "$this->baseUrl/country");
        $countries = json_decode($response);
        return view('management.country.index', compact('countries'));
    }
}
