<?php

namespace Shayvmo\ShayvmoUtil\datetime;

use Shayvmo\ShayvmoUtil\datetime\constants\DateField;

/**
 * Trait DateOffsetUtil 日期时间偏移
 * @package Shayvmo\ShayvmoUtil\datetime
 */
trait DateOffsetUtil
{
    /**
     * 日期偏移
     * @param string $dateStr Y-m-d H:i:s 格式时间
     * @param string $dateField DateField 常量单位
     * @param int $offset 偏移量 +-
     * @return string
     */
    public static function offset(string $dateStr, string $dateField, int $offset): string
    {
        $format = "Y-m-d H:i:s";
        $dateTime = \DateTime::createFromFormat($format, $dateStr);
        if ($dateTime === false) {
            $format = "Y-m-d";
            $dateTime = \DateTime::createFromFormat($format, $dateStr);
            if ($dateTime === false) {
                throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s 或 Y-m-d");
            }
        }
        return $dateTime->modify("{$offset} " . DateField::getDateFieldText($dateField))->format($format);
    }

    /**
     * 日期 年偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetYear(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::YEAR, $offset);
    }

    /**
     * 日期 月偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetMonth(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::MONTH, $offset);
    }

    /**
     * 日期 日偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetDay(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::DAY, $offset);
    }

    /**
     * 日期 小时偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetHour(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::HOUR, $offset);
    }

    /**
     * 日期 分钟偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetMinute(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::MINUTE, $offset);
    }

    /**
     * 日期 秒偏移
     * @param string $dateStr
     * @param int $offset
     * @return string
     */
    public static function offsetSecond(string $dateStr, int $offset): string
    {
        return self::offset($dateStr, DateField::SECOND, $offset);
    }

    /**
     * 昨天
     * @return string
     * @throws \Exception
     */
    public static function yesterday(): string
    {
        return self::offset(DateUtil::format(), DateField::DAY, -1);
    }

    /**
     * 明天
     * @return string
     * @throws \Exception
     */
    public static function tomorrow(): string
    {
        return self::offset(DateUtil::format(), DateField::DAY, 1);
    }

    /**
     * 上周
     * @return string
     * @throws \Exception
     */
    public static function lastWeek(): string
    {
        return self::offset(DateUtil::format(), DateField::DAY, -7);
    }

    /**
     * 下周
     * @return string
     * @throws \Exception
     */
    public static function nextWeek(): string
    {
        return self::offset(DateUtil::format(), DateField::DAY, 7);
    }

    /**
     * 上个月
     * @return string
     * @throws \Exception
     */
    public static function lastMonth(): string
    {
        return self::offset(DateUtil::format(), DateField::MONTH, -1);
    }

    /**
     * 下个月
     * @return string
     * @throws \Exception
     */
    public static function nextMonth()
    {
        return self::offset(DateUtil::format(), DateField::MONTH, 1);
    }
}
