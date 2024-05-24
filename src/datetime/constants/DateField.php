<?php

declare(strict_types=1);

namespace Shayvmo\ShayvmoUtil\datetime\constants;

class DateField
{
    const YEAR = 'year';

    const MONTH = 'month';

    const DAY = 'day';

    const HOUR = 'hour';

    const MINUTE = 'minute';

    const SECOND = 'second';

    /**
     * 获取单位对应文本
     * @param string $dateField
     * @return string
     */
    public static function getDateFieldText(string $dateField): string
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
