<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a given Closure or controller and enjoy the fresh air.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('sign-up', 'RegisterController@showRegistrationForm');
    Route::post('sign-up', 'RegisterController@register');

    Route::get('sign-in', 'LoginController@showLoginForm');
    Route::post('sign-in', 'LoginController@login');

    Route::any('logout', 'LoginController@logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('tweets', 'TweetsController@index')->name('tweets.index');
    Route::post('tweets', 'TweetsController@store')->name('tweets.store');

    Route::get('followers', 'FollowersController@index')->name('followers.index');

    Route::get('following', 'FollowingController@index')->name('following.index');
    Route::post('following', 'FollowingController@store')->name('following.store');
    Route::delete('following/{username}', 'FollowingController@destroy')->name('following.destroy');
});

Route::get('{username}', 'UsersController@show')->name('users.show');
