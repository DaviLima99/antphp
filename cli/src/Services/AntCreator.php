<?php
/**
 *  @author Davi Lima <davi.n.lima99@gmail.com>
 */

namespace Antcli\Services;

use Antcli\Terminal\Colors;
use Antcli\Templater;

class AntCreator extends Service
{
    /**
     *  Const application path
     *  @var string
     */
    const APP_PATH = __DIR__ . "/../../../app";

    private $templater = null;
    
    public function run(array $args) : string
    {
        if (count($args) < 3) {
            return  $this->getMessage('error|command');
        }

        $command = $args[1];
        $className = $args[2];

        return $this->create($command , $className);
    }

    /**
     * Run create process
     *
     * @param string $command
     * @param string $className
     * @return string
     */
    private function create(string $command, string $className) : string
    {
        $this->templater = new Templater();

        switch ($command) {
            case 'create:controller':
                return $this->createController($className);
            case 'create:model':
                return $this->createModel($className);
            case 'auth':
                
            default:
                return $this->getMessage('error|command');
                break;
        }
    }

    /**
     * Generate controller
     *
     * @param string $class
     * @return string
     */
    private function createController(string $class) : string
    {        
        $content = $this->templater->getTemplate('controller');
        $content = str_replace("TemplateController", $class, $content);
        if (file_exists(self::APP_PATH . "/Controllers/{$class}.php")) {
            return $this->getMessage('exist|controller');
        }

        if (!file_put_contents(self::APP_PATH . "/Controllers/{$class}.php", $content, FILE_APPEND)) {
            return $this->getMessage('error|controller');
        }
        
        return str_replace("{controller}", $class, $this->getMessage('success|controller'));
    }

    /**
     * Generate model
     *
     * @param string $class
     * @return string
     */
    private function createModel(string $class) : string
    {
        $content = $this->templater->getTemplate('model');
        $content = str_replace("TemplateModel", $class, $content);
        if (file_exists(self::APP_PATH . "/Models/{$class}.php")) {
            return $this->getMessage('exist|model');
        }

        if (!file_put_contents(self::APP_PATH . "/Models/{$class}.php", $content, FILE_APPEND)) {
            return $this->getMessage('error|model');
        }
        
        return str_replace("{model}", $class, $this->getMessage('success|model'));
    }
    
    protected function messages(): array
    {
        return [
            'success|controller' => Colors::GREEN . "Successfully created {controller}" . Colors::END_COLOR,
            'success|model' => Colors::GREEN . "Successfully created {model}" . Colors::END_COLOR,
            'error|controller' => Colors::RED . "Failed to create controller" . Colors::END_COLOR,
            'error|command' => Colors::RED .  $this->getMenuCommand('create') . Colors::END_COLOR,
            'exist|controller'  => Colors::RED .  "This controller already exists!" . Colors::END_COLOR,
            'exist|model'  => Colors::RED .  "This model already exists!" . Colors::END_COLOR,
        ];   
    }

}
 