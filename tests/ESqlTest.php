<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * 测试 eSql 类的方法
 */
class ESqlTest extends TestCase
{
    private $eSql;

    protected function setUp(): void
    {
        // 模拟全局变量
        $GLOBALS['host'] = '127.0.0.1';
        $GLOBALS['user'] = 'root';
        $GLOBALS['pwd'] = 'usbw';
        $GLOBALS['db'] = 'ksxt';
        
        // 包含类文件（检查是否已加载）
        if (!class_exists('sql_db')) {
            require_once __DIR__ . '/../sql/sql.php';
        }
        if (!class_exists('eSql')) {
            require_once __DIR__ . '/../sql/eSql.php';
        }
        $this->eSql = new \eSql();
    }

    /**
     * 测试 sqlSelect 方法是否存在
     */
    public function testSqlSelectMethodExists()
    {
        $this->assertTrue(method_exists($this->eSql, 'sqlSelect'));
    }

    /**
     * 测试 sqlNum 方法是否存在
     */
    public function testSqlNumMethodExists()
    {
        $this->assertTrue(method_exists($this->eSql, 'sqlNum'));
    }

    /**
     * 测试 sqlSelect2 方法是否存在
     */
    public function testSqlSelect2MethodExists()
    {
        $this->assertTrue(method_exists($this->eSql, 'sqlSelect2'));
    }

    /**
     * 测试 sqlUpdate 方法是否存在
     */
    public function testSqlUpdateMethodExists()
    {
        $this->assertTrue(method_exists($this->eSql, 'sqlUpdate'));
    }
}
