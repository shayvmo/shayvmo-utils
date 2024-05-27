<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil\str;

/**
 * 数据脱敏
 */
class DesensitizedUtil
{
    /**
     * 手机号常规脱敏
     * @param string $mobile
     * @return string
     */
    public static function mobilePhone(string $mobile): string
    {
        $starIndex = 3;
        $endIndex = -4;
        if (strlen($mobile) <= 7) {
            $starIndex = 0;
            $endIndex = 0;
        }
        return StrUtil::hide($mobile, $starIndex, $endIndex);
    }

    /**
     * 身份证脱敏
     * @param string $idCardNum
     * @return string
     */
    public static function idCardNum(string $idCardNum): string
    {
        $starIndex = 1;
        $endIndex = -2;
        if (strlen($idCardNum) <= 3) {
            $starIndex = 0;
            $endIndex = 0;
        }
        return StrUtil::hide($idCardNum, $starIndex, $endIndex);
    }
}
