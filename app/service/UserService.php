<?php

namespace app\service;

use arSql\ArSql;
use infra\Infra;
use app\model\User;

class UserService {

    public function getUser($name) {
        User::createTable();

        $user = User::findOne(['name' => $name]);
        if (!$user) {
            $user = User::instance();
            $user->name = $name;
            Infra::info("Insert user", ['name' => $user->name]);
            $user->save();
        }

        return $user;
    }

}
