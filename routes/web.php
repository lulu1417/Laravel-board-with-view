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

Route::get('', 'UserController@index');
Route::post('user', 'UserController@store');
Route::get('signin', 'UserController@signin');
Route::post('login', 'UserController@login');

Route::get('board', 'PostController@index');
Route::middleware('auth:api')->post('addPost', 'PostController@addPost');
Route::middleware('auth:api')->get('storePost', 'PostController@store');
