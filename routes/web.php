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
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/user', 'UserController@index')->name('all-users');
    Route::delete('/user/{id}', 'UserController@destroy')->name('user-delete');
});

Route::resource('/posts', 'PostController')->middleware('auth', 'role:admin', 'role:moderator');
Route::get('/all', 'PostController@allposts')->name('allposts');
Route::get('/posts/{id}', 'PostController@show');

Route::get('/home', 'HomeController@index')->name('home');
