<?php

namespace App\Controllers;

use Core\Request\RequestParam;

class HomeController
{
    public function index(RequestParam $request, $param)
    {
        echo '<pre>';
        var_dump($request->body());
        die('end');
        
    }

    public function post()
    {

    }
}
