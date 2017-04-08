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

Route::get('/', 'PostController@index')->name('post.index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'post', 'using' => 'PostController'], function () {
    Route::get('post', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('add', 'PostController@add')->name('post.add');
    Route::get('full/{id?}', 'PostController@full')->name('post.full');
    Route::get('getPosts', 'PostController@getPosts')->name('post.getPosts');
});


Route::group(['prefix' => 'profile', 'using' => 'ProfileController'], function () {
    Route::get('settings', 'ProfileController@settings')->name('profile.settings');
    Route::get('display/{name?}', 'ProfileController@display')->name('profile.display');
    Route::post('update', 'ProfileController@update')->name('profile.update');
    Route::get('full/{id}', 'ProfileController@full')->name('profile.full');
    Route::post('upload', 'ProfileController@upload')->name('profile.upload');
    Route::get('avatar', 'ProfileController@avatar');
    Route::post('search', 'ProfileController@search')->name('profile.search');
});

Route::group(['prefix' => 'like'], function () {
    Route::post('like', 'LikeController@like')->name('like.like');
});

Route::group(['prefix' => 'comment'], function () {
    Route::post('create', 'CommentController@create')->name('comment.create');
    Route::post('remove', 'CommentController@remove')->name('comment.remove');
    Route::get('getPostComments/{id}', 'CommentController@getPostComments')->name('comment.getPostComments');
});
