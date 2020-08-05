<?php

$routes = new Core\Router\Router();

$routes->get('/', function() {
    return "TESTE";
});
$routes->post('/', ['HomeController', 'post']);

return $routes;