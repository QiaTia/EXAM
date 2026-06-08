<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * 测试 radio 类的方法
 */
class RadioTest extends TestCase
{
    private $radio;

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
        if (!class_exists('radio')) {
            require_once __DIR__ . '/../sql/test_sql.php';
        }
        $this->radio = new \radio();
    }

    /**
     * 测试 radioTest 方法是否存在
     */
    public function testRadioTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'radioTest'));
    }

    /**
     * 测试 checkboxTest 方法是否存在
     */
    public function testCheckboxTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'checkboxTest'));
    }

    /**
     * 测试 judgeTest 方法是否存在
     */
    public function testJudgeTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'judgeTest'));
    }

    /**
     * 测试 fillTest 方法是否存在
     */
    public function testFillTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'fillTest'));
    }

    /**
     * 测试 saqTest 方法是否存在
     */
    public function testSaqTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'saqTest'));
    }

    /**
     * 测试 curriculumTest 方法是否存在
     */
    public function testCurriculumTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'curriculumTest'));
    }

    /**
     * 测试 test 方法是否存在
     */
    public function testTestMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'test'));
    }

    /**
     * 测试 sql_query 方法是否存在
     */
    public function testSqlQueryMethodExists()
    {
        $this->assertTrue(method_exists($this->radio, 'sql_query'));
    }
}
