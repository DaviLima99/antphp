<?php
/**
 * @author Davi Lima <davi.n.lima99@gmail.com>
 */

namespace Antcli\Services;

use Antcli\Services\Service;
use Antcli\Terminal\Colors;
use Exception;

/**
 * Server command class
 */
class Server extends Service
{

    /**
     * Undocumented variable
     *
     * @var string
     */
    private $host = null;

    const LOCALHOST = '127.0.0.1';

    /**
     * Run command
     *
     * @param array $args
     * @return void
     */
    public function run(array $args)
    {
        if (!$this->processArgs($args)) {
            return [
                'message'   => $this->getMessage('param')
            ];
        }
        

        echo  Colors::GREEN  . "The server will be started on:" .  Colors::END_COLOR. "[{$this->host}:{$this->port}]";
        passthru(PHP_BINARY . " -S {$this->host}:{$this->port} -t public");
    }

    /**
     * Process command params
     *
     * @param array $args
     * @return boolean
     */
    private function processArgs(array $args) : bool
    {
        if (count($args) < 2) {
            return false;
        }

        $this->host = $this->getHost($args);
        $this->port = $this->getPort($args);
        
        return true;
    }

    /**
     * Return port
     *
     * @param array $args
     * @return string
     */
    private function getPort(array $args) : string
    {
        foreach ($args as $param) {
            if (strpos($param , 'port') ) {
                return $this->processPortParam($param);
            }
        }
        
        // @todo Criar verificador da porta
        // $rrPorts = array(21, 25, 8000, 81, 110, 443, 3306);
        $rrPorts = 8000;
        return $rrPorts;
        // foreach ($rrPorts as $port)
        // {
            // if ($this->isOpen($port)) {
            //     // var_dump($port);
            //     // die('end');
            // }
        // }

    }

    // private function isOpen(int $port) : bool
    // {
    //     $connection = @fsockopen(self::LOCALHOST, $port, $errno, $errstr, 30);
    //     echo '<pre>';
    //     var_dump($errstr);
    //     die();
        
    //     if (is_resource($connection)) {
    //         return true;
    //     }

    //     return false;
    // }

    /**
     * Process port param and return port
     *
     * @param string $portParam
     * @return string
     */
    private function processPortParam(string $portParam) : string
    {
        if (strpos($portParam, 'port') === false) {
            throw new Exception('AAAAAAAAAAAAAA');
        }

        return '';
    }

    /**
     *  Return port
     *
     * @param array $args
     * @return string
     */
    private function getHost(array $args) : string
    {
        if (in_array('host', $args)) {
            foreach ($args as $key => $value) {
                if ($value === 'host') {
                    return isset($args[$key + 1]) ?: 'localhost';
                }
            }
        }

        return 'localhost';
    }

    /**
     * Return open ports
     *
     * @return string
     */
    private function getOpenPort() : string
    {
        return '8080';
    }

    /**
     * Message config
     *
     * @return array
     */
    protected function messages(): array
    {
        return [
            'param' =>  Colors::RED . "Invalid params, try antphp.php create:controller CLASS_NAME" . Colors::END_COLOR
        ];
    }
}
