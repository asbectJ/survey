<?php

namespace tests;

use tests\TestCase;
use app\controller\IndexController;
use infra\Infra;

class IndexControllerTest extends TestCase {

    protected $controller;

    public function setUp()
    {
        $this->controller = Infra::make(IndexController::class);
    }

    public function testActionIndex()
    {
        $resp = $this->controller->actionIndex();
        $this->assertContains('<h1>It works!</h1>', $resp->getContent());
    }

    public function testActionAjax() {
        $resp = $this->controller->actionAjax();
        $this->assertEquals(['user' => 'dogstar'], $resp);
    }
}

