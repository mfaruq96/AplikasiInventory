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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index');

// Route Kategori
Route::get('/kategori', 'KategoriController@index');
Route::get('/kategori/{id}', 'KategoriController@update');
Route::post('/kategori', 'KategoriController@store');
Route::delete('/kategori/{id}', 'KategoriController@destroy');

// Route Produk
Route::get('/produk', 'ProdukController@index');
Route::post('/produk/{id}', 'ProdukController@update');
Route::post('/produk', 'ProdukController@store');
Route::delete('/produk/{id}', 'ProdukController@destroy');
Route::get('/produk/detail/{id}', 'ProdukController@show');

// Route Stok
Route::get('/stok', 'StokController@index');
Route::post('/stok', 'StokController@store');
Route::delete('/stok/{id}', 'StokController@destroy');
