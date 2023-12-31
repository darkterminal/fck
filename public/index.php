<?php

use Fckin\core\Application;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once __DIR__ . '/../config/app.php';

$app = new Application(dirname(__DIR__), $config);

require_once __DIR__ . '/../routers/web.php';

$app->run();
