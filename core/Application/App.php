<?php

namespace Core\Application;

use Core\Router\Router;

class App 
{
    private $router;

    public function route(Router $router) : App
    {
        $this->router = $router;
        return $this;
    }


    public function run() : void {
       $config = $this->getConfig();
       
       switch ($_SERVER["REQUEST_METHOD"]) {
            case Router::METHOD_GET:
                // (new RouteRequestGet($this->routes[Router::METHOD_GET]))->run($currentUrl);
                break;
            case Router::METHOD_POST:
                // (new RouteRequestPost($this->routes[Router::METHOD_POST]))->run($currentUrl);
                break;
            default:
                # code...
                break;
        }
    }

}