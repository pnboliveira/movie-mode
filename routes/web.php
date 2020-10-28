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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/comments', 'CommentController');
Route::resource('/user', 'UserController')->middleware('auth','role:admin');

Route::resource('/posts', 'PostController')->middleware('auth','role:admin','role:moderator');
Route::get('/all', 'PostController@allposts')->name('allposts');
Route::get('/posts/{id}', 'PostController@show');

Route::get('/home', 'HomeController@index')->name('home');
