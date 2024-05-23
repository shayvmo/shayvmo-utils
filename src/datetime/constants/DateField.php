<?php

namespace Shayvmo\ShayvmoUtil\datetime\constants;

class DateField
{
    const YEAR = 1;

    const MONTH = 2;

    const DAY = 3;
    const HOUR = 4;

    const MINUTE = 5;

    const SECOND = 6;

    /**
     * 获取单位对应文本
     * @param int $dateField
     * @return string
     */
    public static function getDateFieldText(int $dateField): string
    {
        switch ($dateField) {
            case self::YEAR:
                $dateFieldText = "years";
                break;
            case self::MONTH:
                $dateFieldText = "months";
                break;
            case self::DAY:
                $dateFieldText = "days";
                break;
            case self::HOUR:
                $dateFieldText = "hours";
                break;
            case self::MINUTE:
                $dateFieldText = "minutes";
                break;
            case self::SECOND:
                $dateFieldText = "seconds";
                break;
            default:
                throw new \RuntimeException("dateField 不存在");
        }
        return $dateFieldText;
    }
}