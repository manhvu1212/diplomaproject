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
    Route::get('/', ['as' => 'index', 'uses' => 'Controller@index']);

    Route::get('/logout', ['as' => 'logout', 'uses' => function () {
        $user = Sentinel::getUser();
        Sentinel::logout($user);
        return Redirect::back();
    }]);

    Route::group(['namespace' => 'Backend', 'middleware' => 'guest'], function () {
        Route::get('/login', ['as' => 'login', 'uses' => function () {
            return view('layout.frontend.login');
        }]);
        Route::post('/login', 'UserController@login');

        Route::get('/signup', ['as' => 'signup', 'uses' => function() {
            return view('layout.frontend.signup');
        }]);
        Route::post('/signup', 'UserController@signup');

        Route::get('/activation/{user_id}/{code}', ['as' => 'activation', 'uses' => 'UserController@activation']);
    });

    Route::group(['as' => 'admin::', 'namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'AdminController@index']);

        Route::group(['as' => 'user::', 'prefix' => 'user'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::get('/role/{role}', ['as' => 'role', 'uses' => 'UserController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'UserController@add']);
            Route::get('/edit/{userID}', ['as' => 'edit', 'uses' => 'UserController@add']);
            Route::post('/save/{userID?}', ['as' => 'save', 'uses' => 'UserController@save']);
            Route::post('/delete/{userID}', ['as' => 'delete', 'uses' => 'UserController@delete']);
            Route::get('/{userID}', ['as' => 'view', 'uses' => 'UserController@view']);
        });

        Route::group(['as' => 'media::', 'prefix' => 'media'], function() {
            Route::get('/', ['as' => 'index', 'uses' => 'MediaController@index']);
        });
    });
});

Route::get('/construct', function() {
    Sentinel::getRoleRepository()->createModel()->create([
        'name' => 'Admin',
        'slug' => 'admin',
    ]);
    Sentinel::getRoleRepository()->createModel()->create([
        'name' => 'Master',
        'slug' => 'master',
    ]);
    Sentinel::getRoleRepository()->createModel()->create([
        'name' => 'Member',
        'slug' => 'member',
    ]);
    $credentials = [
        'email'    => 'manhvu1212@gmail.com',
        'password' => '12345678',
        'first_name' => 'Vũ',
        'last_name' => 'Nguyễn Mạnh',
    ];
    $user = Sentinel::register($credentials);
    $activation = Activation::create($user);
    Activation::complete($user, $activation['code']);

    $role = Sentinel::findRoleBySlug('admin');
    $role->users()->attach($user);

});



