<?php

namespace Core;

/**
 * 
 * Request Class
 * 
 * 
 * 
 */
class Request
{
    /**
     * POST method array
     *
     * @var array
     */
    private $post = [];

    /**
     * GET method array
     *
     * @var array
     */
    private $get = [];
    
    public function __construct()
    {
        $this->getRequest();
    }

    /**
     *
     * @return void
     */
    private function getRequest()
    {
        foreach ($_GET as $key => $value){
            $this->get[$key] = $value;
        }
        
        foreach ($_POST as $key => $value){
            $this->post[$key] = $value;
        }
    }

    /**
     * Return post params
     *
     * @return void
     */
    public function post()
    {
        return $this->post;
    }

    /**
     * Return post params
     *
     * @return void
     */
    public function get()
    {
        return $this->get;
    }
}
