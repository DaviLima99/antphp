<?php

$router = new Core\Router\Router();

// $router->get('/teste/{id}', function($teste) {
//     echo "Página inicial " . $teste;
// });

$router->get('/teste/{id}', 'HomeController@index');
 
$router->get('/contatos', 'HomeController@index');
 
// $router->post('/contatos/store', "Controller@store");

return $router;