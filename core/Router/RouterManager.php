<?php

namespace Core\Router;

use Core\Router\Router;

class RouterManager {

    /**
     * Array GET Routes
     */
    private $routesGet = [];

    /**
     *  Array POST Routes
     */
    private $routesPost = [];

    /**
     *  Array PUT Routes
     */
    private $routesPut = [];

    /**
     *  Array DELETE Routes
     */
    private $routesDelete = [];

    public function add(string $method, string $route, $callback)
    {
        switch ($method) {
            case Router::METHOD_GET:
                $this->addGet($route, $callback);
            break;
            case Router::METHOD_POST:
                $this->addPost($route, $callback);
                break;
            case Router::METHOD_PUT:
                # code...
                break;
            case Router::METHOD_DELETE:
                # code...
                break;
            default:
                # code...
                break;
        }
    }

    /**
     *  Add Get Routes
     */
    private function addGet(string $route, $callback) : RouterManager
    {
        $params = $this->bindParams($route);

        $this->routesGet[$this->defineRoute($route)] = [
            'params' => $params,
            'callback' => $callback
        ];

        return $this;
    }

    private function defineRoute($pattern) {
 
        $pattern = implode('/', array_filter(explode('/', $pattern)));
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
     
        if (preg_match("/\{[A-Za-z0-9\_\-]{1,}\}/", $pattern)) {
            $pattern = preg_replace("/\{[A-Za-z0-9\_\-]{1,}\}/", "[A-Za-z0-9]{1,}", $pattern);
        }
     
        return $pattern;
     
    }

    /**
     * Add Post Routes
     */
    private function addPost(string $route, $callback) : RouterManager
    {
        $params = $this->bindParams($route);

        
        $this->routesPost[1] = [
            'params' => $params,
            'callback' => $callback
        ];

        return $this;
    }

    /**
     * Add Put Routes
     */
    private function addPut(string $route, $callback) : RouterManager
    {
        $params = $this->bindParams($route);
        
        $this->routesPut[1] = [
            'params' => $params,
            'callback' => $callback
        ];

        return $this;
    }

    /**
     *  Return route params
     */
    private function bindParams(string $route)
    {
        $route = array_filter(explode('/', $route));
        $result = [];

        foreach ($route as $key => $value) {

            if ($this->hasParam($value) !== false && substr($value, 0, 1) === '{') {
                $result[preg_filter('/([\{\}])/', '', $value)] = $key;
                continue;
            }

            $index = 'value_' . !empty($result) ? count($result) + 1 : 1;
            array_merge($result, [$index => $key - 1]); 
        }

        return count($result) > 0 ? $result : false;
    }

    /**
     *  Check if route has params
     */
    private function hasParam($char)
    {
        $filter = '{';
    
        return strpos($char, $filter, 0);
    }

    public function findRoute(string $method, string $uri)
    {
        switch ($method) {
            case Router::METHOD_GET:
                return $this->findByGet($uri);
            break;
            case Router::METHOD_POST:
                // return $this->findByPost($uri);
            break;
            case Router::METHOD_PUT:
                // return $this->findByPut($uri);
            break;
            case Router::METHOD_DELETE:
                // return $this->findByDelete($uri);
                break;
            default:
                # code...
                break;
        }
    }

    private function parseUri(string $uri)
    {
        return implode('/', array_filter(explode('/', $uri)));
    }

    private function findByGet(string $uri)
    {
        $parsedUri = $this->parseUri($uri);

        foreach ($this->routesGet as $route => $callback) {
            if(preg_match($route, $parsedUri, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }

        return false;
    }
  
}