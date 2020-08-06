<?php

namespace Core\Router;

use Core\Router\RouterManager;
use Core\Router\Dispatcher;
use Core\Request\Request;

class Router {

    /**
     * 
     */
    const METHOD_GET = 'GET';

    /**
     * 
     */
    const METHOD_POST = 'POST';

    /**
     * 
     */
    const METHOD_PUT = 'PUT';

    /**
     * 
     */
    const METHOD_DELETE = 'DELETE';

    /**
     * 
     */
    private $routerManager;

    /**
     * 
     */
    private $dispacher;
    
    public function __construct()
    {
        $this->routerManager = new RouterManager();
        $this->dispatcher = new Dispatcher();
    }

    public function get(string $route, $callback) : Router
    {
        $this->routerManager->add(self::METHOD_GET, $route, $callback);
        return $this;
    }

    public function post(string $route, $callback) : Router
    {
        $this->routerManager->add(self::METHOD_POST, $route, $callback);
        return $this;
    }

    public function put(string $route, $callback) : Router
    {
        $this->routerManager->add(self::METHOD_PUT, $route, $callback);
        return $this;
    }

    public function delete(string $route, $callback) : Router
    {
        $this->routerManager->add(self::METHOD_DELETE, $route, $callback);
        return $this;
    }

    public function resolveRequest(Request $request)
    {
        $route = $this->findRoute($request->method(), $request->uri());
        
        if (!$route) {
            return $this->responseNotFound();
        }

        $params = $route->callback['params'] ? $this->getValues($request->uri(), $route->callback['params']) : [];

        $this->dispatch($route, $params);
        
    }

    private function getValues($pattern, $positions)
    {
        $result = [];

        $pattern = array_filter(explode('/', $pattern));
    
        foreach($pattern as $key => $value)
        {
            if(in_array($key, $positions)) {
                $result[array_search($key, $positions)] = $value;
            }
        }
    
        return $result;
        
    }

    protected function responseNotFound()
    {
        return header("HTTP/1.0 404 Not Found", true, 404);
    }

    private function findRoute(string $method, string $uri)
    {
        return $this->routerManager->findRoute($method, $uri);
    }

    private function dispatch(object $route, array $params)
    {
        return $this->dispatcher->dispatch($route->callback, $params);
    }

}