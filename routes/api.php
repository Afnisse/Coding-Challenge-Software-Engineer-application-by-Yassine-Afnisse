<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/products', 'ProductsController@index');
Route::get('/products/{id}', 'ProductsController@show');

Route::post('/products', 'ProductsController@store');

Route::get('/categories/list', 'CategoriesController@categoryDistinctList');
