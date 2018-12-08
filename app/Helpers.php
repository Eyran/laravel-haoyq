<?php
/**
 * Helpers.php
 * 自定义函数
 * Author: haoyq
 * Date: 2018/12/8
 */

if (!function_exists('bubbleSort')) {
    /**
     * 冒泡排序
     * @param $arr
     * @return array|bool
     */
    function bubbleSort($arr)
    {
        if (!is_array($arr)) {
            return false;
        }

        $count = count($arr);

        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$i] > $arr[$j]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$i];
                    $arr[$i] = $temp;
                }
            }
        }

        return $arr;
    }
}