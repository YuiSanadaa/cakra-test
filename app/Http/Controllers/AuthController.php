<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Session;
use Alert;
use Exception;

class AuthController extends Controller
{
    protected $baseUrl = 'http://backend-dev.cakra-tech.co.id/api';

    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {

        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard');
    }


    public function register(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post("$this->baseUrl/register", [
                'json' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                ]
            ]);
            Alert::success('Success Register !', "Now You Can Login :)");
            return redirect("login");
        } catch (ClientException $e) {
            Alert::error('Failed Register !', "Please Contact Admin!");
            return back();
        }
    }

    public function login(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->post("$this->baseUrl/login", [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            if (isset($data['token'])) {
                Session::put('jwt_token', $data['token']);
            }
            Alert::success('Selamat Datang !');
            return redirect('dashboard');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents());
            Alert::error('Failed Login !', "{$body->error}");
            return back();
        }
    }

    public function changePasswordView()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post("$this->baseUrl/change-password", [
                'json' => [
                    'oldPassword' => $request->oldPassword,
                    'newPassword' => $request->password,
                ]
            ]);
            Alert::success('Success Change Password !', "Please Remind Your New Password :)");
            return redirect("dashboard");
        } catch (ClientException $e) {
            Alert::error('Failed Change Password !', "Please Contact Admin!");
            return back();
        }
    }

    public function logout()
    {
        Session::forget('jwt_token');
        return redirect('login');
    }

    public function getUser()
    {
        $client = new Client();
        $token = Session::get('jwt_token');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response = $client->get("$this->baseUrl/country", [
            'headers' => [
                'Authorization' => "Bearer $token",
            ]
        ]);
    }
}
