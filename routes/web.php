<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('register', [AuthController::class, 'registration'])
    ->name('register');
Route::post('register', [AuthController::class, 'register'])
    ->name('register.post');

Route::group(['middleware' => ['jwt'], 'namespace' => 'App\Http'], function () {
    Route::any('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'changePasswordView'])
        ->name('change_password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('change-password.post');
    Route::prefix('country')->group(function () {
        Route::get('/index', [CountryController::class, 'index'])
            ->name('index-country');
    });
    Route::prefix('province')->group(function () {
        Route::get('/index', [ProvinceController::class, 'index'])
            ->name('index-province');
    });
    Route::prefix('city')->group(function () {
        Route::get('/index', [CityController::class, 'index'])
            ->name('index-province');
    });
});
