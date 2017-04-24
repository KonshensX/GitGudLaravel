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

/**
 * PostController Routes
 */
Route::group(['prefix' => 'post', 'using' => 'PostController'], function () {
    Route::get('post', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('add', 'PostController@add')->name('post.add');
    Route::get('full/{id?}', 'PostController@full')->name('post.full');
    Route::get('getPosts', 'PostController@getPosts')->name('post.getPosts');
});


/**
 * ProfileController Routes
 */
Route::group(['prefix' => 'profile', 'using' => 'ProfileController'], function () {
    Route::get('settings', 'ProfileController@settings')->name('profile.settings');
    Route::get('display/{name?}', 'ProfileController@display')->name('profile.display');
    Route::post('update', 'ProfileController@update')->name('profile.update');
    Route::get('full/{id?}', 'ProfileController@full')->name('profile.full');
    Route::post('upload', 'ProfileController@upload')->name('profile.upload');
    Route::get('avatar', 'ProfileController@avatar')->name('profile.avatar');
    Route::post('search', 'ProfileController@search')->name('profile.search');

    Route::get('search/{query}', 'ProfileController@getSearchResult')->name('profile.searchResult');
    
    Route::post('follow', 'ProfileController@follow')->name('profile.follow');
    Route::get('{name?}/following', 'ProfileController@following')->name('profile.following');
    Route::get('{name?}/profiles', 'ProfileController@getProfiles')->name('profile.profiles');
    Route::post('getUserPosts', 'ProfileController@getUserPosts')->name('profile.userPosts');

    Route::get('{query?}/followers', 'ProfileController@followers')->name('profile.followers');
    Route::get('{query?}/getFollowers', 'ProfileController@getFollowers')->name('profile.getFollowers');
});

/**
 * Post liking routes
 */
Route::group(['prefix' => 'like'], function () {
    Route::post('like', 'LikeController@like')->name('like.like');
});

/**
 * Commenting Routes
 */
Route::group(['prefix' => 'comment'], function () {
    Route::post('create', 'CommentController@create')->name('comment.create');
    Route::post('remove', 'CommentController@remove')->name('comment.remove');
    Route::get('getPostComments/{id}', 'CommentController@getPostComments')->name('comment.getPostComments');
});

/**
 * Url for testing l9lawi li mabaghcih ykhdam 
 */
Route::group(['prefix' => 'test'], function () {
    Route::get('followed', 'TestController@followed');
});