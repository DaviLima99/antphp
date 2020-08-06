<?php

use Core\Request\RequestParam;

$router = new Core\Router\Router();

$router->get('/teste/{id}', function(RequestParam $request, $id) {
    echo "Página inicial " . $id;
    // echo "Página inicial ";
    // echo '<pre>';
    // var_dump($request->headers()->Authorization);
    // die('end');
    
});

// $router->get('/teste/{id}', 'HomeController@index');
 
$router->get('/contatos', 'HomeController@index');
$router->post('/create/user', 'HomeController@index');
 
// $router->post('/contatos/store', "Controller@store");

return $router;