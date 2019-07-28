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

//$router->get('/', function () use ($router) {
//    return "Hello World !";
//});
$router->get('/',
[
    'as' => 'home',
    'uses' => 'MainController@home'
]);

$router->get('/toto-route',
[
    'as' => 'toto',
    'uses' => 'MainController@totoAction'
]);

$router->get('/admin',
[
    'as' => 'admin',
    'uses' => 'MainController@admin'
]);

$router->post('/admin',
[
    'as' => 'adminPost',
    'uses' => 'MainController@adminPost'
]);

$router->get('/login',
[
    'as' => 'login-form',
    'uses' => 'MainController@login'
]);

$router->post('/login',
[
    'as' => 'login-process',
    'uses' => 'MainController@loginPost'
]);

$router->get('/logout',
[
    'as' => 'logout',
    'uses' => 'MainController@logout'
]);
