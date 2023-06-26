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
//在庫一覧を表示
Route::get('/zaiko', 'API\ApiController@index');

//在庫IDを指定でその内容のみ表示
Route::get('/zaiko/{id?}', 'API\ApiController@show');

Route::post('/products', 'API\ApiController@store');

Route::post('/Update/{id?}','API\ApiController@Update');




