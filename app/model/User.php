<?php

namespace app\model;

use infra\db\ActiveRecord;
use arSql\ArSql;
use infra\Infra;

class User extends ActiveRecord {

    public static function tableName() {
        return 'app.user';
    }

    public static function createTable() {
        ArSql::createCommand("use app")->execute();
        $hasTbl = ArSql::createCommand("show tables like '%user%'")->queryScalar();
        if (!$hasTbl) {
            Infra::info('Create table `user`');
            ArSql::createCommand(
                "create table if not exists app.user" .
                "(id int unsigned primary key auto_increment, name varchar(16) not null default '')"
            )->execute();
        }
    }

}