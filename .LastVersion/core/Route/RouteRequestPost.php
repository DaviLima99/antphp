<?php

namespace Core\Route;

class RouteRequestPost extends AbstractRouteRequest
{
    
    private $routeMatch = [];

    public function run(string $url)
    {
        $routes = $this->routes;

        $this->doMatch($url, $routes);
        $this->dispatch();

    }
    
    private function dispatch()
    {
        if (empty($this->routeMatch)) {
            die('404');
        }

        $controller = ClassBuilder::instanceController($this->routeMatch['controller']);
        $action = $this->routeMatch['action'];
        $request = $this->request(Router::METHOD_POST);
        $controller->$action($request);
    }

    /**
     *  
     */
    private function doMatch(string $url, array $routes) : void
    {
        foreach ($routes as $route) {
            $explodeUrl = explode('/', $url);
            $explodeRoute = explode('/', $route[0]);
            $dispatch = $route[1];
            
            if (count($explodeUrl) === count($explodeRoute) && (strpos(end($explodeRoute), '{') !== false) ) {
                throw new \Exception("Error Processing Request", 1);
            }

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
}
