<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil\datetime;

/**
 * 日期时间
 */
class DateUtil
{
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
        return self::date($timestamp)->format("Y-m-d H:i:s");
    }

    /**
     * 自定义格式化日期时间字符串，默认：Y-m-d H:i:s
     * @param int $timestamp
     * @param string $format
     * @return string
     */
    public static function formatCustom(int $timestamp = 0, string $format = "Y-m-d H:i:s"): string
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
        return self::date($timestamp)->format("Y-m-d");
    }

    /**
     * 格式化日期时间字符串 H:i:s
     * @param int $timestamp 时间戳
     * @return string
     * @throws \Exception
     */
    public static function formatTime(int $timestamp = 0): string
    {
        return self::date($timestamp)->format("H:i:s");
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
     * @return string
     */
    public static function beginOfMonth(string $dateStr): string
    {
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $dateStr);
        if ($dateTime === false) {
            $dateTime = \DateTime::createFromFormat("Y-m-d", $dateStr);
            if ($dateTime === false) {
                throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s 或 Y-m-d");
            }
        }
        return $dateTime->format("Y-m-01 00:00:00");
    }

    /**
     * 一月的结束，结果：2024-05-31 23:59:59
     * @param string $dateStr 日期格式 2024-05-23 23:59:59
     * @return string
     */
    public static function endOfMonth(string $dateStr): string
    {
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $dateStr);
        if ($dateTime === false) {
            $dateTime = \DateTime::createFromFormat("Y-m-d", $dateStr);
            if ($dateTime === false) {
                throw new \RuntimeException("日期格式必须是 Y-m-d H:i:s 或 Y-m-d");
            }
        }
        return $dateTime->modify("last day of this month")->format("Y-m-d 23:59:59");
    }

    /**
     * 一月的开始，结果：2024-05-01 00:00:00
     * @param string $dateStr 日期格式 2024-05-23 23:59:59
     * @param string $format 自定义格式 Y-m-d H:i:s
     * @return string
     */
    public static function beginOfMonthCustom(string $dateStr, string $format): string
    {
        $dateTime = \DateTime::createFromFormat($format, $dateStr);
        if ($dateTime === false) {
            throw new \RuntimeException("日期格式无法解析");
        }
        return $dateTime->format("Y-m-01 00:00:00");
    }

    /**
     * 一月的结束，结果：2024-05-31 23:59:59
     * @param string $dateStr 日期格式 2024-05-23 23:59:59
     * @param string $format 自定义格式 Y-m-d H:i:s
     * @return string
     */
    public static function endOfMonthCustom(string $dateStr, string $format): string
    {
        $dateTime = \DateTime::createFromFormat($format, $dateStr);
        if ($dateTime === false) {
            throw new \RuntimeException("日期格式无法解析");
        }
        return $dateTime->modify("last day of this month")->format("Y-m-d 23:59:59");
    }
}
