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

Route::middleware('auth:api')->post('storeComment', 'CommentController@store')->name('storeComment');

Route::middleware('auth:api')->post('storeReply', 'ReplyController@store')->name('storeReply');

Route::middleware('auth:api')->post('storeLike', 'LikeController@store')->name('storeLike');
Route::middleware('auth:api')->post('dislike', 'LikeController@destroy')->name('dislike');

Route::get('allPost', 'PostController@allPost')->name('allPost');
Route::post('allComment', 'CommentController@allComment')->name('allComment');
Route::post('allLike', 'LikeController@allLike')->name('allLike');
Route::post('allReply', 'ReplyController@allReply')->name('allReply');

Route::post('time', 'PostController@transfer');
