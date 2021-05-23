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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::post('/sanctum/token', 'Auth\AuthClientController@auth');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/auth/me', 'Auth\AuthClientController@me');
        Route::post('/auth/logout', 'Auth\AuthClientController@logout');
    });

    Route::get('/tenants/{uuid}', 'TenantController@show');
    Route::get('/tenants', 'TenantController@index');

    Route::get('/categories/{url}', 'CategoryController@show');
    Route::get('/categories', 'CategoryController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableController@show');
    Route::get('/tables', 'TableController@tablesByTenant');

    Route::get('/products/{flag}', 'ProductController@show');
    Route::get('/products', 'ProductController@productByTenant');


    Route::post('/client', 'Auth\RegisterController@store');


});

