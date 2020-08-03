<?php

namespace App\Controllers;

use Core\AbstractController;
use App\Models\Usuario;

class HomeController extends AbstractController
{
    /**
     * Return index page
     *
     * @param string $id
     * @return void
     */
    public function index($id)
    {
        $request = $this->request()->get();


        Usuario::find(1);
        die();


        $data = $request;
        $this->view('index/index', 'layouts/default', $data);
    }
}
