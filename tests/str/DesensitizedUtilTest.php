<?php

declare(strict_types=1);


namespace str;


use PHPUnit\Framework\TestCase;
use Shayvmo\ShayvmoUtil\str\DesensitizedUtil;

class DesensitizedUtilTest extends TestCase
{
    public function testMobilePhone()
    {
        $this->assertEquals(DesensitizedUtil::mobilePhone("13800138000"), "138****8000");
        $this->assertEquals(DesensitizedUtil::mobilePhone("13800138000138"), "138*******0138");
        $this->assertEquals(DesensitizedUtil::mobilePhone("11312"), "*****");
        $this->assertEquals(DesensitizedUtil::mobilePhone("1234567"), "*******");
        $this->assertEquals(DesensitizedUtil::mobilePhone("12345678"), "123*5678");
    }

    public function testIdCardNum()
    {
        $this->assertEquals(DesensitizedUtil::idCardNum("51343620000320711X"), "5***************1X");
    }
}
