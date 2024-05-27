<?php

declare(strict_types=1);


namespace str;


use PHPUnit\Framework\TestCase;
use Shayvmo\ShayvmoUtil\str\StrUtil;

class StrUtilTest extends TestCase
{
    public function testIsEmpty()
    {
        $this->assertTrue(StrUtil::isEmpty(""));
        $this->assertFalse(StrUtil::isEmpty(" "));
        $this->assertFalse(StrUtil::isEmpty("0"));
        $this->assertFalse(StrUtil::isEmpty(" 0"));
    }

    public function testIsBlank()
    {
        $this->assertTrue(StrUtil::isBlank(""));
        $this->assertTrue(StrUtil::isBlank(" "));
        $this->assertFalse(StrUtil::isBlank(" 0"));
        $this->assertFalse(StrUtil::isBlank("0"));
    }

    public function testFormat()
    {
        $this->assertEquals(StrUtil::format("{}月{}日", "05", 27), "05月27日");
    }

    public function testHide()
    {
        $str = "123456";
        $this->assertEquals(StrUtil::hide(""), "");
        $this->assertEquals(StrUtil::hide($str), "******");
        $this->assertEquals(StrUtil::hide($str, 10), "123456");
        $this->assertEquals(StrUtil::hide($str, 5), "12345*");
        $this->assertEquals(StrUtil::hide($str, 6, -2), "123456");
        $this->assertEquals(StrUtil::hide($str, 0, 1), "*23456");
        $this->assertEquals(StrUtil::hide($str, 1), "1*****");
        $this->assertEquals(StrUtil::hide("11258", 3, -4), "112**");
        $this->assertEquals(StrUtil::hide($str, 1, 3), "1**456");
        $this->assertEquals(StrUtil::hide($str, 1, -1), "1****6");
        $this->assertEquals(StrUtil::hide($str, 1, -10), "1*****");
        $this->assertEquals(StrUtil::hide($str, 1, -5), "123456");
        $this->assertEquals(StrUtil::hide($str, 1, -4), "1*3456");
        $this->assertEquals(StrUtil::hide($str, 1, -3), "1**456");
        $this->assertEquals(StrUtil::hide($str, -4, -3), "12*456");
        $this->assertEquals(StrUtil::hide($str, 1, -3, 'Y'), "1YY456");
    }
}
