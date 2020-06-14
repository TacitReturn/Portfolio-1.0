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



Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('posts', 'PostsController')->middleware('auth');
    Route::resource('categories', 'CategoriesController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

// Restore trashed post
    Route::put('restore-post/{id}', 'PostsController@restore')->name('restore-post');
});



