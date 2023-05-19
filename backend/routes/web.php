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

use App\Http\Controllers\ZaikoController;
use App\Http\Controllers\HomeController;


// showは表示する・exeは実行する
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->middleware(['auth'])->name('login');


Auth::routes();
Route::redirect('/home', '/zaiko');


// 在庫一覧を表示する
Route::get('/zaiko', [ZaikoController::class, 'showList'])->name('zaikos');

// 在庫登録画面を表示する
Route::get('/zaiko/create', [ZaikoController::class, 'showCreate'])->name('create')->middleware('auth');

//CSV出力
Route::get('/zaiko/export-csv', [ZaikoController::class, 'export'])->name('zaikos.export')->middleware('auth');

// 在庫登録
Route::post('/zaiko/store', [ZaikoController::class, 'exeStore'])->name('store')->middleware('auth');

// 詳細を表示する
Route::get('/zaiko/{id}', [ZaikoController::class, 'showDetail'])->name('show')->middleware('auth');

// 詳細編集画面を表示する
Route::get('/zaiko/edit/{id}', [ZaikoController::class, 'showEdit'])->name('edit')->middleware('auth');

// 在庫編集
Route::post('/zaiko/update', [ZaikoController::class, 'exeUpdate'])->name('update')->middleware('auth');

// 在庫削除
Route::post('/zaiko/delete/{id}', [ZaikoController::class, 'exeDelete'])->name('delete')->middleware('auth');




