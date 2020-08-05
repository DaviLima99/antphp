<?php

namespace Core\Request;

class Request
{
    private $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }
}