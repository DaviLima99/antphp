<?php

namespace Core\App;

use Core\Router\Router;
use Core\Request\Request;

class App
{
    private $router;

    private $request;

    public function route(Router $router) : App
    {
        $this->router = $router;
        return $this;
    }


    public function run() : void {
        $currentURL = $this->getCurrentURL();
        $this->request = new Request($_REQUEST);

        $this->router->run($currentURL, $this->request);
    }

     /**
     * Return current url
     *
     * @return string
     */
    private function getCurrentURL() : string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

}