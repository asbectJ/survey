<?php

use infra\Infra;
use app\controller\IndexController;
use Symfony\Component\Routing\Route;

return function($options) {
    $routes = Infra::make('routes');

    $routes->add('home', new Route('/home', ['_getController' => function() {
        return [IndexController::class, 'actionIndex'];
    }]));
};