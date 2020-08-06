<?php

namespace Core\Router;

use Core\Request\RequestParam;
use Core\Router\ClassBuilder;

class Dispatcher {

    public function dispatch($callback, $params = [])
    {   
        if (is_callable($callback['callback']))
        {
            return $this->dispatchCallable($callback, $params);
        }

        if (!is_string($callback['callback'])) {
            throw new \Exception("Erro ao despachar: método não implementado");
        }

        if(!strpos($callback['callback'], '@')) {
            throw new \Exception("Dispatch error: Wrong syntax.");         
        }

        
        $callback['callback'] = explode('@', $callback['callback']);
        $controller = $callback['callback'][0];
        $action = $callback['callback'][1];
        
        $objController = ClassBuilder::instanceController($controller);
        $requestParam = new RequestParam();
        $objController->$action($requestParam, $params);

        throw new \Exception("Erro ao despachar: método não implementado");
    }

    private function dispatchCallable(array $callback, array $params)
    {
        $requestParam = new RequestParam();
        $params = array_shift($params);
        
        return call_user_func($callback['callback'], $requestParam, $params);
    }
}