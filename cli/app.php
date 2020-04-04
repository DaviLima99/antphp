<?php

use Antcli\AntCli;
use Antcli\Printer;
use Antcli\Services\AntCreator;
use Antcli\Services\Server;

$app = new AntCli(new Printer());

/**
 * CREATE COMMANDS
 */
$app->register('create', function (array $argv) use ($app) {
    $result = (new AntCreator)->run($argv);
    $app->getPrinter()->display($result);
})->register('create:model', function (array $argv) use ($app) {
    $result = (new AntCreator)->run($argv);
    $app->getPrinter()->display($result);
})->register('create:controller', function (array $argv) use ($app) {
    $result = (new AntCreator)->run($argv);
    $app->getPrinter()->display($result);
})->register('create:auth', function (array $argv) use ($app) {
    die('ops');
    $result = (new AntCreator)->run($argv);
    $app->getPrinter()->display($result);
});;

/** RUN APPLICATION */
$app->register('server', function (array $argv) use($app) {
    (new Server)->run($argv);
});

return $app;
