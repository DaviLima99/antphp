<?php

namespace Core;

/**
 *  Abstract class for controllers
 * 
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 * 
 */
abstract class AbstractController
{
    /**
     * View instance
     *
     * @var View
     */
    protected $view = null;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Render view
     *
     * @param string $view
     * @param string $template
     * @param array $param
     * @return void
     */
    protected function view(string $view, string $template = null,  array $param = []) : void
    {
        $this->view->render($view, $param, $template);
    }

    /**
     * Return a Request intance
     *
     * @return Request
     */
    protected function request() : Request
    {
        return (new Request());
    }
}
