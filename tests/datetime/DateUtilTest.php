<?php

declare(strict_types=1);

namespace datetime;

use PHPUnit\Framework\TestCase;
use Shayvmo\ShayvmoUtil\datetime\constants\DateUnit;
use Shayvmo\ShayvmoUtil\datetime\DateUtil;

class DateUtilTest extends TestCase
{
    private $time = 1716543114;

    private $timeStr = "2024-05-24 17:31:54";

    public function testDate()
    {
        $timeStr = new \DateTime($this->timeStr);
        $dateTime = DateUtil::date($this->time);
        $this->assertEquals($dateTime, $timeStr);
    }

    public function testFormat()
    {
        $this->assertEquals(DateUtil::format(), DateUtil::format(-1));
        $this->assertEquals(DateUtil::format($this->time), $this->timeStr);
    }

    public function testFormatCustom()
    {
        $this->assertEquals(DateUtil::formatCustom($this->time), $this->timeStr);
        $this->assertEquals(DateUtil::formatCustom($this->time, "Y-m-d"), substr($this->timeStr, 0, 10));
    }

    public function testFormatDate()
    {
        $this->assertEquals(DateUtil::formatDate($this->time), substr($this->timeStr, 0, 10));
    }

    public function testFormatTime()
    {
        $this->assertEquals(DateUtil::formatTime($this->time), substr($this->timeStr, 11));
    }

    public function testFormatISO()
    {
        $this->assertEquals(DateUtil::formatISO($this->time), "2024-05-24T17:31:54+08:00");
    }

    public function testBeginOfDay()
    {
        $this->assertEquals(DateUtil::beginOfDay($this->time), substr($this->timeStr, 0, 10) . " 00:00:00");
    }

    public function testEndOfDay()
    {
        $this->assertEquals(DateUtil::endOfDay($this->time), substr($this->timeStr, 0, 10) . " 23:59:59");
    }

    public function testBeginOfMonth()
    {
        $expectDate = "2024-05-01";
        $expectDateTime = "2024-05-01 00:00:00";
        $this->assertEquals(DateUtil::beginOfMonth("2024-05-24"), $expectDateTime);
        $this->assertEquals(DateUtil::beginOfMonth("2024-05-24", "Y-m-d"), $expectDate);
    }

    public function testEndOfMonth()
    {
        $expectDate = "2024-02-29";
        $expectDateTime = "2024-02-29 23:59:59";
        $this->assertEquals(DateUtil::endOfMonth("2024-02-24"), $expectDateTime);
        $this->assertEquals(DateUtil::endOfMonth("2024-02-24", "Y-m-d"), $expectDate);
    }

    public function testBetween()
    {
        $startTimestamp = strtotime("2024-05-01");
        $endTimestamp = strtotime("2024-05-04");
        $betweenWeek = DateUtil::between($startTimestamp, $endTimestamp, DateUnit::WEEK);
    }
}
