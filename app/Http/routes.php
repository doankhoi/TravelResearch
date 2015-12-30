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
    return redirect(route('auth.login'));
});

Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']); 

/* Route for user admin */
Route::group(['namespace' => 'Website', 'middleware' => 'website'], function() {
    Route::get('/top', ['as' => 'top', 'uses' => 'WebsiteController@index']);

    //Facebook
    Route::get('/facebook/login', ['as' => 'facebook.login', 'uses' => 'WebsiteController@loginFacebook']);
    Route::get('/facebook/callback', 'WebsiteController@facebookCallback');
    Route::get('/updateOnlyListFace', ['as' => 'list.only.face', 'uses' => 'WebsiteController@updateOnlyListFace']);
    Route::get('/updateAllListFace', ['as' => 'list.all.face', 'uses' => 'WebsiteController@updateAllListFace']);
    Route::get('/listface', ['as' => 'list.face', 'uses' => 'WebsiteController@listface']);
    Route::get('/downloadFace', ['as' => 'list.face.download', 'uses' => 'WebsiteController@downloadFace']);

    //Twitter
    Route::get('/addTwitter', ['as' => 'add.twitter', 'uses' => 'WebsiteController@addTwitter']);
    Route::post('/addTwitter', ['as' => 'add.twitter.store', 'uses' => 'WebsiteController@storeScreenName']);
    Route::get('/listTwitter', ['as' => 'list.twitter', 'uses' => 'WebsiteController@listTwitter']);
    Route::get('/downloadTwitter', ['as' => 'list.twitter.download', 'uses' => 'WebsiteController@downloadTwitter']);

    Route::get('/twitter/login', ['as' => 'twitter.login', 'uses' => 'WebsiteController@loginTwitter']);
    Route::get('/twitter/callback', ['as' => 'twitter.callback', 'uses' => 'WebsiteController@twitterCallback']);
    Route::get('/updatedListTwitter', ['as' => 'list.all.twitter', 'uses' => 'WebsiteController@updatedListTwitter']);
    Route::get('/demo', function() {
        return dd(Twitter::getUsers(['screen_name' => 'nta_jp', 'count' => 20, 'format' => 'array']));
    });
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
