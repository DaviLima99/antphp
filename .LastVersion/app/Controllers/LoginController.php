<?php

namespace App\Controllers;

use Core\AbstractController;

/**
 * Login controller
 */
class LoginController extends AbstractController
{
    /**
     * Return index page
     *
     * @return void
     */
    public function index()
    {
        $this->view('index/index', 'layouts/default');
    }
}
