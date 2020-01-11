<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
    // return 'Me and I';
});

// logging in a user for a token
$router->post('/login', 'AuthController@postLogin');

// registering a new user
$router->post('/user/register', 'AuthController@postRegister');

// group 1
$router->group(['middleware' => 'auth:api', 'prefix' => 'api/v1'], function($router){
	$router->get('/system/users', 'UserController@index');
	$router->get('/system/users/{id}', 'UserController@show');
});

$router->group(['middleware' => 'auth:api', 'prefix' => 'api/v1'], function($router){
	// 
});

