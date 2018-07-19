<?php

return function($options) {
    // 注册依赖注入
    $di = require __DIR__ . '/di.php';
    $di($options);

    // 注册事件
    $event =  require __DIR__ . '/event.php';
    $event($options);

    // 注册自定义路由
    $route = require __DIR__ . '/route.php';
    $route($options);
};