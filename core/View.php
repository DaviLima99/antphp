<?php

namespace Core;

class View
{
    private $viewPath = null;
    private $param = [];

    public function render(string $path, array $param = [], string $template = null) : View
    {
        $this->viewPath = $path;
        $this->param = $param;
        if (isset($param['title'])) {
            // Set title
        }

        if ($template) {
            $this->renderViewWithTemplate($template, $param);
            return $this;
        }

        $this->renderView($path);
        return $this;
    }

    private function renderViewWithTemplate(string $template, array $param)
    {
        extract($param, EXTR_PREFIX_SAME, 'wddx');
        if (!file_exists(dirname(__DIR__)."/app/Views/{$template}.phtml")) {
            return 'Error: Tempalte path not found!';
        }

        include dirname(__DIR__)."/app/Views/{$template}.phtml";
    }

     /**
     * rederiza o conteúdo na tela
     */
    public function renderContent()
    {   
        extract($this->param, EXTR_PREFIX_SAME, 'wddx');
        if (!file_exists(dirname(__DIR__)."/app/Views/{$this->viewPath}.phtml")) {
            die("404");
        }

        include dirname(__DIR__)."/app/Views/{$this->viewPath}.phtml";
    }

    public function assets_css($string)
    {
        echo "<link href='/assets/css/{$string}' rel='stylesheet'>";
    }
    
    public function theme(string $theme)
    {
        echo "<link href='/assets/css/theme/bootstrap-{$theme}.min.css' rel='stylesheet'>";
    }
}
