<?php

namespace Core\Route;

use Core\ClassBuilder;

/**
 * 
 * Execute request route GET
 * 
 * @author Davi Lima <davi.n.lima99@gmail.com>
 * 
 */
class RouteRequestGet extends AbstractRouteRequest
{

    private $routeMatch = [];

    public function run(string $url)
    {
        $routes = $this->routes;

        $this->doMatch($url, $routes);
        $this->dispatch();

    }
    
    private function dispatch() : void
    {
        if (empty($this->routeMatch)) {
            die('404');
        }

        $controller = ClassBuilder::instanceController($this->routeMatch['controller']);
        $param = $this->routeMatch['param'];
        $action = $this->routeMatch['action'];
        $request = $this->request(Router::METHOD_GET);

        if (!empty($param)) {
            $controller->$action($param, $request);
            return;
        }

        $controller->$action($param, $request);
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
                if (!$this->routeParamMatch($explodeRoute, $explodeUrl, $dispatch)) {
                    continue;
                }

                break;
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

    /**
     * Verify GET parameter
     *
     * @param array $explodeRoute
     * @param array $explodeUrl
     * @param array $dispatch
     * @return void
     */
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
}
