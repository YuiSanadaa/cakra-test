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
        $response = $this->client->get('/country');
        $countries = json_decode($response->getBody(), true);

        return view('countries.index', compact('countries'));
    }

    public function show($id)
    {
        $response = $this->client->get("/country/$id");
        $country = json_decode($response->getBody(), true);

        return view('countries.show', compact('country'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function edit($id)
    {
        $response = $this->client->get("/country/$id");
        $country = $response->json();

        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->client->post("country", [
            'json' => [
                'id' => $id,
                'country_code' => $request->country_code,
                'country_name' => $request->country_name,
            ]
        ]);
        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy($id)
    {
        $response = Http::delete("$this->apiBaseUrl/country/$id");

        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }
}
