<?php declare(strict_types=1);

const ROOT = __DIR__ . '/..';
const TEMPLATE_DIR = __DIR__ . '/../templates';

require_once ROOT . '/vendor/autoload.php';

use MyCms\SiteLoader;

$siteLoader = new SiteLoader();
$siteLoader->load($_SERVER['HTTP_HOST']);