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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/cekdata', 'RekeningController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'user'], function () {
    // info customer
    Route::get('info', 'UserController@info')->name('customer.info');
    // transfer
    Route::get('transfer', 'UserController@transfer')->name('customer.transfer');
    Route::post('transfer/cek', 'UserController@cekTransfer')->name('transfer.saldo');

    // tarik tunai
    Route::get('tarik', 'UserController@tarik')->name('customer.tarik');
    Route::post('tarik', 'UserController@prosesTarik')->name('tarik.saldo');
});

Route::post('transfer/proses', 'UserController@prosesTransfer')->name('transfer.proses');

















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

    // Route Delete Data
    Route::get('/customer/hapus/{id}', 'AdminController@hapusCustomer');

    // route Rekening
    Route::get('/rekening', 'RekeningController@index')->name('rekening');

    // tambah data rekening
    Route::post('/rekening/tambah', 'RekeningController@create')->name('tambah.rekening');

    // Route Edit data rekening
    Route::get('/rekening/edit/{id}', 'RekeningController@edit')->name('ubah.customer');

    // Route Delete Data Rekening
    Route::get('/rekening/hapus/{id}', 'RekeningController@destroy');




    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
});

// proses ubah data customer
Route::put('/customer/update/{id}', 'AdminController@updateCustomer');

// proses ubah data rekening
Route::put('/rekening/update/{id}', 'RekeningController@update');


// test URI
Route::get('/tesindex', function () {
    return view('admin.layouts.layoutAdmin');
});
