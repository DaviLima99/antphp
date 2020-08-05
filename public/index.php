<?php
/**
 *  AntPHP Microframework.
 */
require_once __DIR__.'/../vendor/autoload.php';


$app =  new Core\App\App();
$routes = require_once("../routes/routes.php");

$app->route($routes);

$app->run();

