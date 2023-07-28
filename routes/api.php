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



Route::get('/product', '\App\Http\Controllers\ProductController::class@index');
Route::post('/product', '\App\Http\Controllers\ProductController@store');
Route::get('/product/{id}', '\App\Http\Controllers\ProductController@show');
Route::put('/product', '\App\Http\Controllers\ProductController@update');
Route::delete('/product', '\App\Http\Controllers\ProductController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
