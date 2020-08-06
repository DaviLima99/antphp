<?php

namespace App\Controllers;

class HomeController
{
    public function index($param)
    {
        echo '<pre>';
        var_dump($param);
        die('end');
        
    }

    public function post()
    {

    }
}
