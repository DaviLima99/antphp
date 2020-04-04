<?php
/**
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 */

namespace Antcli;

class Templater
{
    public function getTemplate(string $template) : string
    {
        switch ($template) {
            case 'controller':
                return $this->getControllerTemplateContent();
                break;
            case 'model':
                return $this->getModelTemplateContent();
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Return content file of tempalte controller
     *
     * @return string
     */
    private function getControllerTemplateContent() : string
    {
        return file_get_contents(__DIR__ . '/templates/controller.php');
    }

    /**
     * Return content file of tempalte controller
     *
     * @return void
     */
    private function getModelTemplateContent() : string
    {
        return file_get_contents(__DIR__ . '/templates/model.php');
    }
}
