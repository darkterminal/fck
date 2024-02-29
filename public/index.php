<?php

use Fckin\core\Fck;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Fck(dirname(__DIR__));
$app->boot();
