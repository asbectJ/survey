<?php

use infra\Infra;
use infra\App;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$bootstrap = require dirname(__DIR__) . '/vendor/infra/infra/bootstrap.php';
$config = $bootstrap([
    'baseDir' => dirname(__DIR__),
    'appNamespace' => 'app',
]);

Infra::makeWith(App::class, $config);