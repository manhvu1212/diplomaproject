<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'Controller@index');

    Route::get('/logout', ['as' => 'logout', 'uses' => function () {
        $user = Sentinel::getUser();
        Sentinel::logout($user);
        return Redirect::back();
    }]);

    Route::group(['namespace' => 'Backend', 'middleware' => 'guest'], function () {
        Route::get('/login', ['as' => 'login', 'uses' => function () {
            return view('layout.backend.login');
        }]);
        Route::post('/login', 'UserController@login');

        Route::get('/signup', ['as' => 'signup', 'uses' => function() {
            return view('layout.backend.signup');
        }]);
    });

    Route::group(['as' => 'admin::', 'namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'AdminController@index']);
        Route::group(['as' => 'user::', 'prefix' => 'user'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
        });
    });
});





