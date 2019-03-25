<?php

/*
/Report all PHP errors, but use only in the development
*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

// include Composer's autoloader
$vendor = __DIR__.'/../vendor/autoload.php'; 

if (!file_exists($vendor)) {
    throw new RuntimeException('Install dependencies to run this script.');
}

require_once $vendor;

use \PlugRoute\PlugRoute;

$route = new PlugRoute();

$route->group(['prefix' => '/api'], function($route) {
	$route->get('/user', '\Acme\Controller\UserController@list');
	$route->get('/user/{id}', '\Acme\Controller\UserController@find');
	$route->post('/user', '\Acme\Controller\UserController@storage');
	$route->delete('/user/{id}', '\Acme\Controller\UserController@delete');
	$route->put('/user/{id}', '\Acme\Controller\UserController@update');
});
 
$route->on();
