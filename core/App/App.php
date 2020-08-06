<?php

namespace Core\App;

use Core\Router\Router;
use Core\Request\Request;

class App
{
    private $router;

    public function route(Router $router) : App
    {
        $this->router = $router;
        return $this;
    }


    public function run() : void {
        $request = new Request();

        $this->router->resolveRequest($request);
    }
}