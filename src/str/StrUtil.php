<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil\str;

/**
 * 字符串
 */
class StrUtil
{
    /**
     * 是否为空，空格不为空
     * @param string $str
     * @return bool
     */
    public static function isEmpty(string $str): bool
    {
        if ($str !== '') {
            return false;
        }
        return empty($str);
    }

    /**
     * 是否为空，空格为空
     * @param string $str
     * @return bool
     */
    public static function isBlank(string $str): bool
    {
        $str = trim($str);
        return self::isEmpty($str);
    }

    /**
     * 字符串格式化
     * @param string $str 字符串格式 eg: "今天是{}月{}号"
     * @param mixed ...$params 可变参数
     * @return string
     */
    public static function format(string $str, ...$params): string
    {
        $strReplace = str_replace("{}", "%s", $str);
        return sprintf($strReplace, ...$params);
    }

    /**
     * 字符串脱敏
     * @param string $str 源字符串
     * @param int $startIndex 开始下标（包含）
     * @param int $endIndex 结束下标（不包含）
     * @param string $hideChar 脱敏转换字符
     * @return string
     */
    public static function hide(string $str, int $startIndex = 0, int $endIndex = 0, string $hideChar = '*'): string
    {
        if (self::isBlank($str)) {
            return "";
        }

        $extensionName = "mbstring";
        if (extension_loaded($extensionName)) {
            $length = mb_strlen($str);
        } else {
            $length = strlen($str);
        }

        if ($startIndex >= $length) {
            return $str;
        }

        if (($startIndex === 0 && $startIndex === $endIndex)) {
            return str_repeat($hideChar, $length);
        }

        if (abs($endIndex) >= $length) {
            $endIndex = $length;
        }

        if ($endIndex < 0) {
            $endIndex = $length + $endIndex;
        }

        if ($endIndex === 0) {
            $endIndex = $length;
        }

        if ($startIndex < 0) {
            $startIndex = $length + $startIndex;
        }

        $diff = $endIndex - $startIndex;

        if ($diff < 0) {
            $diff = $length - $startIndex;
        }

        return substr_replace($str, str_repeat($hideChar, $diff), $startIndex, $diff);
    }
}
