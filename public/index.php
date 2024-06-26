<?php

die('<pre>' . print_r($_SERVER, true) . '</pre>');

require_once __DIR__ . '/../vendor/autoload.php';

use MyCms\Router;

const TEMPLATE_DIR = __DIR__ . '/../templates';


$viewEngine = new League\Plates\Engine(TEMPLATE_DIR);

$router = new Router($viewEngine);
$router->route();