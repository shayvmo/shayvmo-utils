<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil\datetime;

/**
 * 日期时间
 */
class DateUtil
{
    const COMMON_FULL_FORMAT = "Y-m-d H:i:s";

    const COMMON_DATE_FORMAT = "Y-m-d";

    const COMMON_TIME_FORMAT = "H:i:s";

    use DateOffsetUtil, DateDiffUtil;

    /**
     * 返回DateTime
     * @param int $timestamp 时间戳
     * @return \DateTime
     */
    public static function date(int $timestamp = 0): \DateTime
    {
        $dateTime = new \DateTime("now");
        $timestamp > 0 && $dateTime->setTimestamp($timestamp);
        return $dateTime;
    }

    /**
     * 常规格式化日期时间字符串 Y-m-d H:i:s
     * @param int $timestamp 时间戳
     * @return string
     * @throws \Exception
     */
    public static function format(int $timestamp = 0): string
    {
        return self::date($timestamp)->format(self::COMMON_FULL_FORMAT);
    }

    /**
     * 自定义格式化日期时间字符串，默认：Y-m-d H:i:s
     * @param int $timestamp
     * @param string $format
     * @return string
     */
    public static function formatCustom(int $timestamp = 0, string $format = self::COMMON_FULL_FORMAT): string
    {
        return self::date($timestamp)->format($format);
    }

    /**
     * 格式化日期时间字符串 Y-m-d
     * @param int $timestamp 时间戳
     * @return string
     * @throws \Exception
     */
    public static function formatDate(int $timestamp = 0): string
    {
        return self::date($timestamp)->format(self::COMMON_DATE_FORMAT);
    }

    /**
     * 格式化日期时间字符串 H:i:s
     * @param int $timestamp 时间戳
     * @return string
     * @throws \Exception
     */
    public static function formatTime(int $timestamp = 0): string
    {
        return self::date($timestamp)->format(self::COMMON_TIME_FORMAT);
    }

    /**
     * ISO 8601 格式化日期字符串 2024-05-23T18:23:56+08:00
     * @param int $timestamp
     * @return string
     */
    public static function formatISO(int $timestamp = 0): string
    {
        return self::date($timestamp)->format("c");
    }

    /**
     * 一天的开始，结果：2024-05-23 00:00:00
     * @param int $timestamp
     * @return string
     */
    public static function beginOfDay(int $timestamp = 0): string
    {
        return self::date($timestamp)->format("Y-m-d 00:00:00");
    }

    /**
     * 一天的结束，结果：2024-05-23 23:59:59
     * @param int $timestamp
     * @return string
     */
    public static function endOfDay(int $timestamp = 0): string
    {
        return self::date($timestamp)->format("Y-m-d 23:59:59");
    }

    /**
     * 一月的开始，结果：2024-05-01 00:00:00
     * @param string $dateStr 日期格式 2024-05-23 23:59:59
     * @param string $returnFormat
     * @return string
     */
    public static function beginOfMonth(string $dateStr, string $returnFormat = "Y-m-d 00:00:00"): string
    {
        $dateTime = \DateTime::createFromFormat(self::COMMON_FULL_FORMAT, $dateStr);
        if ($dateTime === false) {
            $dateTime = \DateTime::createFromFormat(self::COMMON_DATE_FORMAT, $dateStr);
            if ($dateTime === false) {
                throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s 或 Y-m-d");
            }
        }
        return $dateTime->modify("first day of this month")->format($returnFormat);
    }

    /**
     * 一月的结束，结果：2024-05-31 23:59:59
     * @param string $dateStr 日期格式 2024-05-23 23:59:59
     * @param string $returnFormat
     * @return string
     */
    public static function endOfMonth(string $dateStr, string $returnFormat = "Y-m-d 23:59:59"): string
    {
        $dateTime = \DateTime::createFromFormat(self::COMMON_FULL_FORMAT, $dateStr);
        if ($dateTime === false) {
            $dateTime = \DateTime::createFromFormat(self::COMMON_DATE_FORMAT, $dateStr);
            if ($dateTime === false) {
                throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s 或 Y-m-d");
            }
        }
        return $dateTime->modify("last day of this month")->format($returnFormat);
    }
}
