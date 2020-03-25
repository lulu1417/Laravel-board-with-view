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

Route::post('signup', 'UserController@store')->name('signup');
Route::post('login', 'UserController@login')->name('login');

Route::get('board', 'PostController@index')->name('board');
Route::middleware('auth:api')->post('storePost', 'PostController@store')->name('storePost');

Route::post('storeComment', 'CommentController@store')->name('storeComment');
