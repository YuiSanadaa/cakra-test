<?php

namespace App\Http\Controllers;

use App\Helpers\GuzzleHelper;

class ProvinceController extends Controller
{
    private $baseUrl = 'http://backend-dev.cakra-tech.co.id/api';

    public function index()
    {
        $response = GuzzleHelper::request('GET', "$this->baseUrl/province");
        $provinces = json_decode($response);
        // dd($provinces);
        return view('management.province.index', compact('provinces'));
    }
}
