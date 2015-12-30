<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => []], function () {
    Route::get('/home', 'Admin\CategoriesController@index');
});

/**
 * Group ADMIN Routes
 */
Route::group(['namespace'  => 'Admin',
              'prefix'     => 'admin',
              'as'         => 'admin.',
              'middleware' => ['authRole:admin']], function () {
    /**
     * Routes for categories
     */
    Route::get('categories', ['as' => 'categories.index', 'uses' => 'CategoriesController@index']);
    Route::get('categories/create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
    Route::post('categories/store', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
    Route::get('categories/edit/id/{id}', ['as' => 'categories.edit.id', 'uses' => 'CategoriesController@edit']);
    Route::post('categories/update/id/{id}', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
    Route::get('categories/destroy/id/{id}', ['as' => 'categories.destroy.id', 'uses' => 'CategoriesController@destroy']);

    /**
     * Routes for products
     */
    Route::get('products', ['as' => 'products.index', 'uses' => 'ProductsController@index']);
    Route::get('products/create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
    Route::post('products/store', ['as' => 'products.store', 'uses' => 'ProductsController@store']);
    Route::get('products/edit/id/{id}', ['as' => 'products.edit.id', 'uses' => 'ProductsController@edit']);
    Route::post('products/update/id/{id}', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
    Route::get('products/destroy/id/{id}', ['as' => 'products.destroy.id', 'uses' => 'ProductsController@destroy']);

    /**
     * Routes for clients
     */
    Route::get('clients', ['as' => 'clients.index', 'uses' => 'ClientsController@index']);
    Route::get('clients/create', ['as' => 'clients.create', 'uses' => 'ClientsController@create']);
    Route::post('clients/store', ['as' => 'clients.store', 'uses' => 'ClientsController@store']);
    Route::get('clients/edit/id/{id}', ['as' => 'clients.edit.id', 'uses' => 'ClientsController@edit']);
    Route::post('clients/update/id/{id}', ['as' => 'clients.update', 'uses' => 'ClientsController@update']);
    Route::get('clients/destroy/id/{id}', ['as' => 'clients.destroy.id', 'uses' => 'ClientsController@destroy']);

    /**
     * Routes for orders
     */
    Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('orders/edit/id/{id}', ['as' => 'orders.edit.id', 'uses' => 'OrdersController@edit']);
    Route::post('orders/update/id/{id}', ['as' => 'orders.update', 'uses' => 'OrdersController@update']);

    /**
     * Routes for coupons
     */
    Route::get('coupons', ['as' => 'coupons.index', 'uses' => 'CouponsController@index']);
    Route::get('coupons/create', ['as' => 'coupons.create', 'uses' => 'CouponsController@create']);
    Route::post('coupons/store', ['as' => 'coupons.store', 'uses' => 'CouponsController@store']);
    Route::get('coupons/destroy/id/{id}', ['as' => 'coupons.destroy.id', 'uses' => 'CouponsController@destroy']);
});

/**
 * Group Costumer Routes
 */
Route::group(['namespace'  => 'Costumer',
              'prefix'     => 'costumer',
              'as'         => 'costumer.',
              'middleware' => ['authRole:client']], function () {

    /**
     * Routes for checkout
     */
    Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);
});