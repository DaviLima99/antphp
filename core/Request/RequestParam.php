<?php

namespace Core\Request;

use Core\Router\Router;

class RequestParam
{
    private $body;
    private $headers = [];
    private $method = [];
    private $file = [];

    public function __construct()
    {
        $this->body = $this->setBody();
        $this->header = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->file = 'asa';
    }

    public function headers()
    {
        return (object) $this->header;
    }

    public function body()
    {
        return $this->body;
    }

    private function setBody()
    {
        $obj = new \stdClass;

        
        switch ($_SERVER['REQUEST_METHOD']) {
            
            case Router::METHOD_POST:
                echo '<pre>';
                var_dump(json_decode(file_get_contents('php://input')));
                var_dump(json_decode($_POST));
                die('end');
                
                foreach ($_POST as $key => $value){
                    @$obj->$key = $value;
                }
                break;

            case Router::METHOD_GET:
                foreach ($_GET as $key => $value){
                    @$obj->$key = $value;
                }

                break;

            case Router::METHOD_PUT:
                parse_str(file_get_contents('php://input'), $_PUT);
                foreach ($_PUT as $key => $value){
                    @$obj->$key = $value;
                }

                break;

            case Router::METHOD_DELETE:
                parse_str(file_get_contents('php://input'), $_DELETE);
                foreach ($_DELETE as $key => $value){
                    @$obj->$key = $value;
                }

                break;
            
            default:
                # code...
                break;
        }

        return $obj;
    }
}