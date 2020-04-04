<?php

namespace Core\Route;

use Core\Route\RouteRequestGet;

/**
 *  Implements the routing process
 * 
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 * 
 *  @since 19.07.2019
 * 
 */
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
    
    /**
     *  Array routes
     *
     * @var array
     */
    private $routes = [];

    /**
     * Add route method POST
     *
     * @param string $route
     * @param array $param
     * @return Router
     */
    public function post(string $route,array $param) : Router
    {
        return $this->add($route, $param, self::METHOD_POST);
    }

    /**
     * Add route method GET
     *
     * @param string $route
     * @param array $param
     * @return Router
     */
    public function get(string $route, array $param) : Router
    {
        return $this->add($route, $param, self::METHOD_GET);
    }

    /**
     * Add route
     *
     * @param string $route
     * @param array $param
     * @return Router
     */
    private function add(string $route, array $param, string $method) : Router
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

    /**
     * Execu function
     *
     * @return void
     */
    public function run()
    {
        if (empty($this->routes)) {
            throw new \Exception("Error to process", 1);
        }

        $currentUrl = $this->getCurrentUrl();
        switch ($_SERVER["REQUEST_METHOD"]) {
            case self::METHOD_GET:
                (new RouteRequestGet($this->routes[self::METHOD_GET]))->run($currentUrl);
                break;
            case self::METHOD_POST:
                (new RouteRequestPost($this->routes[self::METHOD_POST]))->run($currentUrl);
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Return current url
     *
     * @return string
     */
    private function getCurrentUrl() : string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
