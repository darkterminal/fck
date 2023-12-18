<?php

use App\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'SiteController@home');
$app->router->get('/contact', 'SiteController@contact');
$app->router->post('/contact', 'SiteController@handleContact');

$app->run();
