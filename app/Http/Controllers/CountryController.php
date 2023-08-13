<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CountryController extends Controller
{
    private $apiBaseUrl = 'http://backend-dev.cakra-tech.co.id/api';
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiBaseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . Session::get('jwt_token'), // Assuming you have stored the JWT token in the session
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function index()
    {
        $client = new Client();
        $token = Session::get('jwt_token');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response = $client->get("$this->apiBaseUrl/country", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);
        $countries = json_decode($response->getBody(), true);
        // dd($countries);
        return view('management.country.index', compact('countries'));
    }

    public function show($id)
    {
        $client = new Client();
        $token = Session::get('jwt_token');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response = $client->get("$this->apiBaseUrl/country/$id", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);
        $countries = json_decode($response->getBody(), true);
        return view('management.country.show', compact('countries'));
    }

    // public function create()
    // {
    //     return view('countries.create');
    // }

    // public function edit($id)
    // {
    //     $response = $this->client->get("/country/$id");
    //     $country = $response->json();

    //     return view('countries.edit', compact('country'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $response = $this->client->post("country", [
    //         'json' => [
    //             'id' => $id,
    //             'country_code' => $request->country_code,
    //             'country_name' => $request->country_name,
    //         ]
    //     ]);
    //     return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $response = Http::delete("$this->apiBaseUrl/country/$id");

    //     return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    // }
}
