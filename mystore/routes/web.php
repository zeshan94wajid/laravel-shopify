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

Route::get('/', function () {
    return view('welcome');
});

Route::put('/customers/update', array(
    'as' => 'customers-update',
    'uses' => 'CustomerController@update'));

Route::put('/products/update', array(
    'as' => 'products-update',
    'uses' => 'ProductController@update'));
