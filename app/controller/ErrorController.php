<?php

namespace app\controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use infra\controller\Controller;
use infra\Infra;

class ErrorController extends Controller {

    protected $exception;

    public function __construct($exception) {
        $this->exception = $exception;
    }

    public function action404() {
        $message = $this->exception->getMessage();
        return "Not Found <!-- {$message} -->";
    }

}
