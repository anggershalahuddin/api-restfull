<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
});

// Authentication
$router->post('/api/v1/account/loggin', 'AccountController@loggin');

// Controller ADMIN
$router->get('/api/v1/admin', 'AdminController@index');
$router->get('/api/v1/admin/{id}', 'AdminController@getById');
$router->post('/api/v1/admin/', 'AdminController@insert');
$router->put('/api/v1/admin/{id}', 'AdminController@update');
$router->delete('/api/v1/admin/{id}', 'AdminController@delete');

// Controller CUSTOMER
$router->get('/api/v1/customer', 'CustomerController@index');
$router->get('/api/v1/customer/{id}', 'CustomerController@getById');
$router->post('/api/v1/customer/', 'CustomerController@insert');
$router->put('/api/v1/customer/{id}', 'CustomerController@update');
$router->delete('/api/v1/customer/{id}', 'CustomerController@delete');

// Controller MOBIL
$router->get('/api/v1/mobil', 'MobilController@index');
$router->get('/api/v1/mobil/{id}', 'MobilController@getById');
$router->post('/api/v1/mobil/', 'MobilController@insert');
$router->put('/api/v1/mobil/{id}', 'MobilController@update');
$router->delete('/api/v1/mobil/{id}', 'MobilController@delete');

// Controller TRANSAKSI
$router->get('/api/v1/transaksi', 'TransaksiController@index');
$router->get('/api/v1/transaksi/{id}', 'TransaksiController@getById');
$router->post('/api/v1/transaksi/', 'TransaksiController@insert');
$router->put('/api/v1/transaksi/{id}', 'TransaksiController@update');
$router->delete('/api/v1/transaksi/{id}', 'TransaksiController@delete');
