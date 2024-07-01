<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use MyApp\Database;
use MyApp\SoapHandler;

$config = include('config.php');

try {
    $db = new Database($config['db']);

    $server = new SoapServer(null, ['uri' => "urn://example.com/soap"]);
    $server->setClass('MyApp\SoapHandler', $db);
    $server->handle();
} catch (\Exception $e) {
    echo $e->getMessage();
}
