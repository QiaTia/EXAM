<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * 测试 sql_db 类
 */
class SqlDbTest extends TestCase
{
    private $sqlDb;

    protected function setUp(): void
    {
        if (!class_exists('sql_db')) {
            require_once __DIR__ . '/../sql/sql.php';
        }
        $this->sqlDb = new \sql_db();
    }

    /**
     * 测试数据库主机配置
     */
    public function testHostProperty()
    {
        $this->assertEquals('127.0.0.1', $this->sqlDb->host);
    }

    /**
     * 测试数据库用户配置
     */
    public function testUserProperty()
    {
        $this->assertEquals('root', $this->sqlDb->user);
    }

    /**
     * 测试数据库密码配置
     */
    public function testPwdProperty()
    {
        $this->assertEquals('usbw', $this->sqlDb->pwd);
    }

    /**
     * 测试数据库名称配置
     */
    public function testDbProperty()
    {
        $this->assertEquals('ksxt', $this->sqlDb->db);
    }
}
