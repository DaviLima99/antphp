<?php
/**
 *  AntPHP Microframework.
 */
require_once __DIR__.'/../vendor/autoload.php';


$router = require_once("../routes/routes.php");
$app =  new Core\App\App();
$app->route($router);
$app->run();

