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
Route::get('/login', 'LoginController@login')->name('login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
