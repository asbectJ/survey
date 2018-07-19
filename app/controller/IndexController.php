<?php

namespace app\controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use infra\controller\Controller;
use infra\Infra;
use app\service\UserService;
use infra\controller\response\QuickSkinResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use arSql\Query;

class IndexController extends Controller {

    protected $userService;

    public function __construct(UserService $userService) {
        // 构造函数依赖注入
        $this->userService = $userService;
    }

    public function actionIndex() {
        // QuickSkin模板例子
        return new QuickSkinResponse('app/view/index/index.html', [
            'title' => 'Index',
            'content' => 'It works!',
            'phpVersion' => PHP_VERSION,
            'json' => json_encode([
                'baseDir' => Infra::getApp()->getBaseDir(),
                'appNamespace' => Infra::getApp()->getAppNamespace(),
            ]),
        ]);
    }

    public function actionUser() {
        // 获取输入参数例子
        $id = (int) $this->input('id', 0);
        $name = $this->request->get('name');

        if (!$name) {
            return new JsonResponse(array('code' => 403, 'message' => 'Empty user name'));
        }

        $user = $this->userService->getUser($name);

        // 返回JSON字符串例子
        return new JsonResponse([
            'code' => 200,
            'message' => '',
            'data' => [
                'attrs' => $user->getAttributes(),
                'id' => $id,
            ]]);
    }

    public function actionAjax() {
        // Api异常例子
        throw new Api_Exception(400, 'no such user');
    }

    public function actionExcept() {
        // http 403 例子
        throw new AccessDeniedHttpException();
    }

    public function actionQuery() {
        // mysql查询例子
        $rows = (new Query())
              ->select(['id'])
              ->from('app.user')
              ->where(['name' => 'Smith'])
              ->limit(10)
              ->all();

        return $rows;
    }

    public function actionLog() {
        // 日志例子
        Infra::info('【模板例子】测试', $_REQUEST);
    }

    public function actionCache() {
        // 缓存例子
        Infra::getCache()->save('key1', 'value1');
        return Infra::getCache()->get('key1');
    }

    public function actionMongo() {
        // Mongo例子
        return Infra::getNoSql()->load('db1', 'tb1', [], ['field1']);
    }

    public function actionMq() {
        // 消息队列例子
        $r = Infra::mqPush('/index/log?test=1'); // GET请求
        return $r;
    }

    public function actionPhpinfo() {
        phpinfo();
    }

    public function __call($name, $arguments) {
        return $this->request->$name($arguments);
    }

}
