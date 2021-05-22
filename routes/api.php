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
    Route::get('/tenants/{uuid}', 'TenantController@show');
    Route::get('/tenants', 'TenantController@index');

    Route::get('/categories/{url}', 'CategoryController@show');
    Route::get('/categories', 'CategoryController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableController@show');
    Route::get('/tables', 'TableController@tablesByTenant');

    Route::get('/products/{flag}', 'ProductController@show');
    Route::get('/products', 'ProductController@productByTenant');
});

