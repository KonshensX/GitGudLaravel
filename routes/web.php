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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/post', 'PostController@index');

Route::group(['prefix' => 'post', 'using' => 'PostController'], function () {
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('add', 'PostController@add')->name('post.add');
});
