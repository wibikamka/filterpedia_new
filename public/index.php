<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = '/home/u1568027/filterpedia_new/storage/framework/maintenance.php')) {
    require $maintenance;
}

require '/home/u1568027/filterpedia_new/vendor/autoload.php';
$app = require_once '/home/u1568027/filterpedia_new/bootstrap/app.php';

$app->handleRequest(Request::capture());