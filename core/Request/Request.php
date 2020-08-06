<?php
 
namespace Core\Request;
 
 
class Request
{
    private $files;
    private $base;
    private $uri;
    private $method;
    private $protocol;
    private $data = [];
 
    public function __construct()
    {
        $this->base = $_SERVER['REQUEST_URI'];
        $this->uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        $this->setData();

        if(count($_FILES) > 0) {
            $this->setFiles();
        }
 
    }
 
    protected function setData()
    {
        switch($this->method)
        {
            case 'post':
                $this->data = $_POST;
                break;
            case 'get':
                $this->data = $_GET;
                break;
            case 'head':
            case 'put':
            case 'delete':
            case 'options':
                parse_str(file_get_contents('php://input'), $this->data);
        }
    }
 
    private function setFiles()
    {
        foreach ($_FILES as $key => $value) {
            $this->files[$key] = $value;
        }
    }
 
    public function base()
    {
        return $this->base;
    }
 
    public function uri()
    {
        return $this->uri;
    }

    public function protocol()
    {
        return $this->protocol;
    }
 
    public function method(){
         
        return $this->method;
    }

    public function all()
    {
        return $this->data;
    }
 
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }
 
    public function __get($key)
    {
        if(isset($this->data[$key])) 
        {
            return $this->data[$key];
        }
    }
 
    public function hasFile($key)
    {
         
        return isset($this->files[$key]);
    }
 
    public function file($key)
    {
         
        if(isset($this->files[$key])) 
        {
            return $this->files[$key];
        }
    }
}