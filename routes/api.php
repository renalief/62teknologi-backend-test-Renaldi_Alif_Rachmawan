<?php

use App\Http\Controllers\api\PostsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/posts/business', 'App\Http\Controllers\api\PostsController@store');
Route::post('/put/business', 'App\Http\Controllers\api\PostsController@store');
Route::delete('/del/business/{id?}', 'App\Http\Controllers\api\PostsController@destroy');
Route::post('/get/business/search', 'App\Http\Controllers\api\PostsController@search');
Route::get('/get/business/', 'App\Http\Controllers\api\PostsController@index');
