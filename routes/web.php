<?php

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

use App\Http\Controllers\RekeningController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/cekdata', 'RekeningController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function () {

    // route auth admin
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    // route dashboard admin
    // Route Customer
    Route::get('/customer', 'AdminController@indexCustomer')->name('customer');

    // Route Tambah data
    Route::post('/customer/tambah', 'Auth\RegisterController@register')->name('tambah.data');

    // Route Edit data
    Route::get('/customer/edit/{id}', 'AdminController@EditCustomer')->name('ubah.customer');
    Route::get('/customer/update/{id}', 'AdminController@updateCustomer')->name('ubah.customer.proses');



    Route::get('/rekening', 'RekeningController@index')->name('rekening');
    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
});


// test URI
Route::get('/tesindex', function () {
    return view('admin.layouts.layoutAdmin');
});
