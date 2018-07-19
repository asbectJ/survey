<?php
/**
 * PhpUnderControl_app\model\User_Test
 *
 * 针对 ../app/model/User.php app\model\User 类的PHPUnit单元测试
 *
 * @author: dogstar 20170616
 */

namespace tests;

use tests\TestCase;
use app\model\User;
use arSql\ArSql;

class UserTest extends TestCase {

    protected function setUp()
    {
        ArSql::createCommand("use app")->execute();
        ArSql::createCommand("drop table if exists app.user")->execute();
    }

    protected function tearDown()
    {
    }

    public function testCreateTable() {
        $hasTbl = ArSql::createCommand("show tables like '%user%'")->queryScalar();
        $this->assertFalse($hasTbl);

        User::createTable();
        $hasTbl = ArSql::createCommand("show tables like '%user%'")->queryScalar();
        $this->assertEquals('user', $hasTbl);
    }

}
