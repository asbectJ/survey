<?php

namespace app\controller\api;

use infra\controller\ApiController;
use infra\exception\ApiException;

class TestController extends ApiController {

    public function actionOk() {
        return "OK";
    }

    public function actionFail() {
        throw (new ApiException())
            ->setCode(1000)
            ->setMessage("Failed")
            ->setData(['reason' => 'xxx']);
    }

}