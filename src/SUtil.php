<?php

declare(strict_types=1);


namespace Shayvmo\ShayvmoUtil;

/**
 * 不分类的工具类
 */
class SUtil
{
    /**
     * 返回简单密码加密
     * @param string $str
     * @param string $nonce_str
     * @return string
     */
    public static function pwdEncrypt(string $str, string $nonce_str = ''): string
    {
        $nonce_str = $nonce_str ?: '\9C!$+SNts2L';
        return md5(md5($str . $nonce_str) . $nonce_str);
    }

    /**
     * 按照数组的key分组
     * @param array $data 待分组数据
     * @param int|string $key 分组key
     * @param int|string|null $key2 分组取原数组某个key值
     * @return array
     */
    public static function arrayGroupByKey(array $data, $key, $key2 = null): array
    {
        $temp = [];
        foreach ($data as $item) {
            if (!isset($item[$key])) {
                return [];
            }
            $temp[$item[$key]][] = $item[$key2] ?? $item;
        }
        return $temp;
    }

    /**
     * 返回树形数据结构
     * @param array $dataList
     * @param int $parentId
     * @param string $primaryKey
     * @param string $parentKey
     * @param string $childrenKey
     * @return array
     */
    public static function getTreeData(array $dataList, int $parentId = 0, string $primaryKey = 'id', string $parentKey = 'parent_id', string $childrenKey = 'children'): array
    {
        $data = [];
        foreach ($dataList as $key => $item) {
            if ($item[$parentKey] === $parentId) {
                $children = self::getTreeData($dataList, (int)$item[$primaryKey], $primaryKey, $parentKey, $childrenKey);
                !empty($children) && $item[$childrenKey] = $children;
                $data[] = $item;
                unset($dataList[$key]);
            }
        }
        return $data;
    }

    /**
     * 2个经纬度之间的距离（单位：米）
     * @param int|float $latitudeFrom 出发纬度
     * @param int|float $longitudeFrom 出发经度
     * @param int|float $latitudeTo 终点纬度
     * @param int|float $longitudeTo 终点经度
     * @return float 单位：米
     */
    public static function longLatDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo): float
    {
        return round(
            6378.138 * 2 * asin(
                sqrt(
                    sin(
                        ($latitudeFrom * M_PI / 180 - $latitudeTo * M_PI / 180) / 2
                    ) ** 2
                    +
                    cos($latitudeFrom * M_PI / 180)
                    * cos($latitudeTo * M_PI / 180)
                    * sin(
                        ($longitudeFrom * M_PI / 180 - $longitudeTo * M_PI / 180) / 2
                    ) ** 2
                )
            ) * 1000
        );
    }
}
