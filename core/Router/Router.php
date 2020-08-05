<?php

namespace Core\Router;

use Core\Request\Request;

class Router 
{
    /**
     * 
     * Const method POST
     * 
     * @var string
     */
    const METHOD_POST = 'POST';
    
    /**
     * 
     * Const method GET
     * 
     * @var string
     */
    const METHOD_GET = 'GET';


    private $request;


    private $routes = [];

    public function run(string $uri, Request $request)
    {
        $this->request = $request;
        $this->match($uri, $this->routes);
        $this->dispatch();
    }
     
    private function dispatch() : void
    {
        if (empty($this->routeMatch)) {
            die('404');
        }

        echo "<br/>";
        var_dump($this->routeMatch);
        die();

        // $controller = ClassBuilder::instanceController($this->routeMatch['controller']);
        // $param = $this->routeMatch['param'];
        // $action = $this->routeMatch['action'];
        // $request = $this->request(Router::METHOD_GET);

        // if (!empty($param)) {
        //     $controller->$action($param, $request);
        //     return;
        // }

        // $controller->$action($param, $request);
    }

    private function match(string $url, array $routes)
    {  
        foreach ($routes as $route) {
            echo "<pre>";
    
            var_dump($route);
            die();
            $explodeUrl = explode('/', $url);
            $explodeRoute = explode('/', $route[0]);
            $dispatch = $route[1];
            
            // if (count($explodeUrl) === count($explodeRoute) && (strpos(end($explodeRoute), '{') !== false) ) {
            //     if (!$this->routeParamMatch($explodeRoute, $explodeUrl, $dispatch)) {
            //         continue;
            //     }

            //     break;
            // }

            if ($this->match($route[0], $url)) {
                $this->routeMatch = [
                    'url' => $route[0],
                    'controller' => $dispatch[0],
                    'action'    => $dispatch[1],
                ];

                break;
            }
        }

        if (empty($this->routeMatch)) {
            die('404');
        }
    }

    private function routeParamMatch(array $explodeRoute, array $explodeUrl, array $dispatch) : bool
    {
        $param = end($explodeUrl);
        array_pop($explodeRoute);
        array_pop($explodeUrl);

        if ($this->match(implode('/', $explodeRoute), implode('/', $explodeUrl))) {
            $this->routeMatch = [
                'url' => implode('/', $explodeRoute),
                'controller' => $dispatch[0],
                'action' => $dispatch[1],
                'param' => $param
            ];

            return true;
        }

        return false;
    }

    private function isMatch(string $route, string $url) : bool
    {
        return $url === $route;
    }


    public function post(string $route, $param) : Router
    {
        return $this->add($route, $param, self::METHOD_POST);
    }

    public function get(string $route, $param) : Router
    {
        return $this->add($route, $param, self::METHOD_GET);
    }

    private function add(string $route, $param, string $method) : Router 
    {
        switch ($method) {
            case self::METHOD_POST:
                $this->routes[self::METHOD_POST][] = [$route, $param, $method];
                break;
            case self::METHOD_GET:
                $this->routes[self::METHOD_GET][] = [$route, $param, $method];
                break;
        }

        return $this; 
    }
}
