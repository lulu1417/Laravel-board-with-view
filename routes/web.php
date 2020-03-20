<?php

use Illuminate\Support\Facades\Route;

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

Route::get('', 'UserController@index')->name('index');
Route::post('user', 'UserController@store')->name('user');
Route::get('signin', 'UserController@signin')->name('signin');
Route::post('login', 'UserController@login')->name('login');

Route::get('board', 'PostController@index')->name('board');
Route::get('addPost', 'PostController@addPost')->name('addPost');
Route::post('storePost', 'PostController@store')->name('storePost');

Route::get('showComments/{post_id}', 'CommentController@index')->name('showComments');
Route::post('storeComment', 'CommentController@store')->name('storeComment');

Route::get('showReplies/{comment_id}', 'ReplyController@index')->name('showReplies');
Route::post('storeReply', 'ReplyController@store')->name('storeReply');

Route::get('showReplies/{post_id}', 'LikeController@index')->name('showLikes');
Route::post('storeLike', 'LikeController@store')->name('storeLike');
