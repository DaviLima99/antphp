<?php

namespace Core\Router;

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

    private $routes = [];

    public function post(string $route, array $param) : Router
    {
        return $this->add($route, $param, self::METHOD_POST);
    }

    private function add(string $route, array $param, string $method) : array 
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
