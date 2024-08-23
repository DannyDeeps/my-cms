<?php declare(strict_types=1);

const ROOT = __DIR__ . '/..';
const THEMES_DIR = __DIR__ . '/../templates/themes/';

require_once ROOT . '/vendor/autoload.php';

use MyCms\{ SiteLoader, Database };
use League\Plates\{ Engine, Template\Theme };

$database = new Database();

$siteLoader = new SiteLoader($database);
$siteLoader->loadFromHost($_SERVER['HTTP_HOST']);

$viewEngine = new League\Plates\Engine(THEMES_DIR . $siteLoader->getProperty('theme'));
$viewEngine->addFolder('themes', THEMES_DIR);

$router = new Router($viewEngine);