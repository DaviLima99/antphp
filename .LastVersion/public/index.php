<?php

/**
 *  AntPHP Microframework.
 */
require_once __DIR__.'/../vendor/autoload.php';

$route = (new Core\Route\Router())
->get('/user/info/{id}', [
    'HomeController',
    'index'
])
->get('/login', [
    'LoginController',
    'index'
])
->get('/user/delete/{id}', [
    'HomeController',
    'index'
])
->get('/', [
    'HomeController',
    'index'
]);

$route->run();


