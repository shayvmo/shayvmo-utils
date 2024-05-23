<?php

namespace Shayvmo\ShayvmoUtil\datetime;

use Shayvmo\ShayvmoUtil\datetime\constants\DateField;

trait DateOffsetUtil
{
    /**
     * 日期偏移
     * @param string $dateStr Y-m-d H:i:s 格式时间
     * @param int $dateField DateField 常量单位
     * @param int $offset 偏移量 +-
     * @return string
     */
    public static function offset(string $dateStr, int $dateField, int $offset): string
    {
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $dateStr);
        if ($dateTime === false) {
            throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s");
        }
        return $dateTime->modify("{$offset} " . DateField::getDateFieldText($dateField))->format("Y-m-d H:i:s");
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
}