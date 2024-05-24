<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil\datetime;

use Shayvmo\ShayvmoUtil\datetime\constants\DateLevel;
use Shayvmo\ShayvmoUtil\datetime\constants\DateUnit;

/**
 * Trait DateDiffUtil 日期时间差
 * @package Shayvmo\ShayvmoUtil\datetime
 */
trait DateDiffUtil
{
    /**
     * 时间差
     * @param int $beginTimestamp 开始时间戳
     * @param int $endTimestamp 结束时间戳
     * @param string $dateUnit 相差单位
     * @return string
     */
    public static function between(int $beginTimestamp, int $endTimestamp, string $dateUnit): string
    {
        $diff = (int) abs($beginTimestamp - $endTimestamp);
        if ($diff === 0) {
            return "同一时间";
        }

        switch ($dateUnit) {
            case DateUnit::WEEK:
                $diffTimeStr = round($diff / 3600 / 24 / 7, 1) . "周";
                break;
            case DateUnit::DAY:
                $diffTimeStr = round($diff / 3600 / 24, 1) . "天";
                break;
            case DateUnit::HOUR:
                $diffTimeStr = round($diff / 3600, 1) . "小时";
                break;
            case DateUnit::MINUTE:
                $diffTimeStr = round($diff / 60, 1) . "分钟";
                break;
            case DateUnit::SECOND:
                $diffTimeStr = "{$diff}秒";
                break;
            default:
                throw new \RuntimeException("暂不支持该时间相差单位");
        }
        return $diffTimeStr;
    }

    /**
     * 格式化相差时间差
     * @param int $diffTimestamp 相差时间秒数
     * @param string $dateLevel 精确单位
     * @return string
     */
    public static function formatBetween(int $diffTimestamp, string $dateLevel): string
    {
        if ($diffTimestamp === 0) {
            return "";
        }

        $dateTimeNow = DateUtil::date();
        $dateTimeDiff = DateUtil::date($dateTimeNow->getTimestamp() + $diffTimestamp);

        $dateInterval = $dateTimeNow->diff($dateTimeDiff);

        $fullMinute = $diffTimestamp > 60;
        $fullHour = $diffTimestamp > 3600;
        $fullDay = $diffTimestamp > 3600 * 24;

        switch ($dateLevel) {
            case DateLevel::DAY:
                $format = $fullDay ? "%a天" : "不足一天";
                break;
            case DateLevel::HOUR:
                if ($fullHour) {
                    $format = "%h小时";
                    if ($fullDay) {
                        $format = "%a天" . $format;
                    }
                } else {
                    $format = "不足一小时";
                }
                break;
            case DateLevel::MINUTE:
                if ($fullMinute) {
                    $format = "%i分钟";
                    if ($fullHour) {
                        $format = "%h小时" . $format;
                    }
                    if ($fullDay) {
                        $format = "%a天" . $format;
                    }
                } else {
                    $format = "不足一分钟";
                }
                break;
            case DateLevel::SECOND:
                $format = "%s秒";
                if ($fullMinute) {
                    $format = "%i分钟" . $format;
                }
                if ($fullHour) {
                    $format = "%h小时" . $format;
                }
                if ($fullDay) {
                    $format = "%a天" . $format;
                }
                break;
            default:
                throw new \RuntimeException("暂不支持该时间精确单位");
        }
        return $dateInterval->format($format);
    }
}
