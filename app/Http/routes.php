<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']); 

/* Route for user */
Route::group(['namespace' => 'Website', 'middleware' => 'website'], function() {

	Route::get('/top', ['as' => 'top', 'uses' => 'WebsiteController@index']);
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);



