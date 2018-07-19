<?php

use infra\Infra;

require_once dirname(__DIR__) . '/vendor/autoload.php';

(require dirname(__DIR__) . '/vendor/infra/infra/bootstrap.php')([
    'baseDir' => dirname(__DIR__),
    'appNamespace' => 'app',
]);

Infra::getApp()->run();
