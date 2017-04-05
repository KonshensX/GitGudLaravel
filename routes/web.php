<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'post', 'using' => 'PostController'], function () {
    Route::get('post', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('add', 'PostController@add')->name('post.add');
});


Route::group(['prefix' => 'profile', 'using' => 'ProfileController'], function () {
    Route::get('display', 'ProfileController@display')->name('profile.display');
    Route::post('update', 'ProfileController@update')->name('profile.update');
    Route::get('full/{id}', 'ProfileController@full')->name('profile.full');
    Route::post('upload', 'ProfileController@upload')->name('profile.upload');
    Route::get('avatar', 'ProfileController@avatar');
    Route::post('search', 'ProfileController@search')->name('profile.search');
});