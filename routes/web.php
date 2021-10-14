<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// REST
Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'getUser'])
    ->name('get_user');

// SOAP Server
Route::get('/wsdl', [\App\Http\Controllers\SOAP\SoapWsdlController::class, 'wsdl']);
Route::post('/server', [\App\Http\Controllers\SOAP\SoapServerController::class, 'server']);

// SOAP Client
Route::get('/getUserSoap/{id}', [\App\Http\Controllers\SOAP\SoapClientController::class, 'client']);
