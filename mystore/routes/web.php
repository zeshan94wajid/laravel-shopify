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

use App\Product;
use App\Customer;
use App\Order;

Route::get('/', function () {
    $products = Product::all();
    $customers = Customer::all();
    $orders = Order::all();
    return view('welcome', compact('products', 'customers', 'orders'));
});

Route::put('/customers/update', array(
    'as' => 'customers-update',
    'uses' => 'CustomerController@update'));

Route::put('/products/update', array(
    'as' => 'products-update',
    'uses' => 'ProductController@update'));

Route::put('/orders/update', array(
    'as' => 'orders-update',
    'uses' => 'OrderController@update'));

Route::get('/orders/average/all', array(
    'as' => 'get-average-order-for-all',
    'uses' => 'OrderController@getAverageOrderForAll'));


Route::post('/customers/orders/average', array(
    'as' => 'get-customer-average-order-value',
    'uses' => 'CustomerController@getOrderAverage'));
