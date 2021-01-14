<?php

use App\Http\Controllers\Auth\LoginController;
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

//ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');
//ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');
//ログインユーザーを返却する
Route::get('/user', function () {
    return \Auth::user();
})->name('user');
//写真を投稿する
Route::post('/photo', 'PhotoController@post')->name('photo.post');
//写真一覧を取得する
Route::get('/photo', 'PhotoController@get')->name('photo.get');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
