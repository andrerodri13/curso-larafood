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
Route::get('/', function () {
    return response()->json(['message' => 'OK']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::post('/auth/register', 'Auth\RegisterController@store');
    Route::post('/auth/token', 'Auth\AuthClientController@auth');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/auth/me', 'Auth\AuthClientController@me');
        Route::post('/auth/logout', 'Auth\AuthClientController@logout');

        Route::post('auth/orders/{identifyOrder}/evaluations', 'EvaluationController@store');


        Route::get('auth/my-orders', 'OrderController@myOrders');
        Route::post('auth/orders', 'OrderController@store');
    });

    Route::get('/tenants/{uuid}', 'TenantController@show');
    Route::get('/tenants', 'TenantController@index');

    Route::get('/categories/{url}', 'CategoryController@show');
    Route::get('/categories', 'CategoryController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableController@show');
    Route::get('/tables', 'TableController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductController@show');
    Route::get('/products', 'ProductController@productByTenant');

    Route::post('/orders', 'OrderController@store');
    Route::get('/orders/{identify}', 'OrderController@show');

});

