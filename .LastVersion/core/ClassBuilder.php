<?php

namespace Core;

/**
 *  Build dynamic class
 * 
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 * 
 */
class ClassBuilder
{
    /**
     * Make a controller instance
     *
     * @param string $contoller
     * @return void
     */
    public static function instanceController(string $contoller)
    {
        $objContoller = "App\\Controllers\\" . $contoller;
        return new $objContoller;
    }
}
