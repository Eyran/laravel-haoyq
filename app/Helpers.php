<?php
/**
 * Helpers.php
 * 自定义函数
 * Author: haoyq
 * Date: 2018/12/8
 */

use \Illuminate\Support\Carbon;

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

if (!function_exists('quickSort')) {
    /**
     * 快速排序
     * @param $arr
     * @return array
     */
    function quickSort($arr)
    {
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }

        $middle = $arr[0];
        $leftArray = $rightArray = array();

        for ($i = 1; $i < $count; $i++) {
            if ($arr[$i] < $middle) {
                $leftArray[] = $arr[$i];
            } else {
                $rightArray[] = $arr[$i];
            }
        }

        return array_merge(quickSort($leftArray), array($middle), quickSort($rightArray));
    }
}

if (!function_exists('computingTime')) {
    /**
     * 计算未来某时与现在时间差
     * @param $date
     * @return bool|int [xx小时xx分钟]
     */
    function computingTime($date)
    {
        $time = strtotime($date);
        if (!$time || $time < time()) {
            return false;
        }

        $now = Carbon::now(config('app.timezone'));
        // 分钟差
        $minutes = $now->diffInMinutes(Carbon::createFromTimestamp($time, config('app.timezone')));

        return floor($minutes / 60) . '小时' . ($minutes % 60) . '分钟';
    }
}