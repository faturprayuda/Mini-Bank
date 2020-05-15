<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Api TES
// cek data
Route::get('customers', 'APIController@customerAPI');

// Register auth
Route::post('auth/register', 'APIController@register');

// login
Route::post('auth/login', 'APIController@login');
// END Api Tes
