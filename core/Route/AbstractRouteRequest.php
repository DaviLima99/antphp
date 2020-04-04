<?php

namespace Core\Route;

/**
 *  Abstract class to route requests
 * 
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 * 
 */
abstract class AbstractRouteRequest
{
    /**
     *  Routes
     *
     * @var array
     */
    protected $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    abstract protected function run(string $url);

    // abstract  function dispatch() : void;

    protected function match(string $route, string $url) : bool
    {
        return $url === $route;
    }

    protected function request(string $method)
    {
        $obj = new \stdClass;

        switch ($method) {
            case Router::METHOD_GET:
                foreach ($_GET as $key => $value){
                    @$obj->get->$key = $value;
                }
                break;
            
            case Router::METHOD_POST:
                foreach ($_POST as $key => $value){
                    @$obj->get->$key = $value;
                }
                break;
        }

        return $obj;
    }
}
