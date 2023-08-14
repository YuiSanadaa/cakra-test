<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\GuzzleHelper;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    protected $baseUrl = 'http://backend-dev.cakra-tech.co.id/api';

    public function index()
    {
        if (Session::get('jwt_token')) return redirect('dashboard');
        return view('auth.login');
    }

    public function registration()
    {
        if (Session::get('jwt_token')) return redirect('dashboard');
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function register(Request $request)
    {
        try {
            $payload = ['name' => $request->name, 'email' => $request->email, 'password' => $request->password, 'password_confirmation' => $request->password_confirmation,];
            GuzzleHelper::request('POST', "$this->baseUrl/register", ['json' => $payload], "register");
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
            $payload = ['email' => $request->email, 'password' => $request->password,];

            $response = GuzzleHelper::request('POST', "$this->baseUrl/login", ['json' => $payload], "login");
            $response = json_decode($response);
            if (isset($response->token)) {
                Session::put('jwt_token', $response->token);
            }

            Alert::success('Selamat Datang !');
            return redirect('dashboard');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody()
                ->getContents());
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
        try {
            $payload = ['oldPassword' => $request->oldPassword, 'newPassword' => $request->password,];
            GuzzleHelper::request('POST', "$this->baseUrl//change-password", ['json' => $payload]);
            Alert::success('Success Change Password !', "Please Remind Your New Password :)");
            return redirect("dashboard");
        } catch (ClientException $e) {
            $response = $e->getResponse();
            Alert::error('Failed Change Password !', "Please Contact Admin!");
            return back();
        }
    }

    public function logout()
    {
        Session::forget('jwt_token');
        return redirect('login');
    }
}
