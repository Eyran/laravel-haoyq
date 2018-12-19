<?php
/**
 * Helpers.php
 * 自定义函数
 * Author: haoyq
 * Date: 2018/12/8
 */

use \Illuminate\Support\Carbon;

if (!function_exists('bubble_sort')) {
    /**
     * 冒泡排序
     * @param $arr
     * @return array|bool
     */
    function bubble_sort(array $arr)
    {
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }

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

if (!function_exists('quick_sort')) {
    /**
     * 快速排序
     * @param $arr
     * @return array
     */
    function quick_sort(array $arr)
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

        return array_merge_perfect(quick_sort($leftArray), $middle, quick_sort($rightArray));
    }
}

if (!function_exists('select_sort')) {
    /**
     * 选择排序
     * @param array $arr
     * @return array
     */
    function select_sort(array $arr)
    {
        $count = count($arr);
        if ($count < 2) {
            return $arr;
        }

        for ($i = 0; $i < $count - 1; $i++) {
            $key = $i;
            for ($j = $i + 1; $j < $count; $j++) {
                if ($arr[$key] > $arr[$j]) {
                    $key = $j;
                }
            }

            if ($key != $i) {
                $temp = $arr[$key];
                $arr[$key] = $arr[$i];
                $arr[$i] = $temp;
            }
        }

        return $arr;
    }
}

if (!function_exists('computing_time')) {
    /**
     * 计算未来某时与现在时间差
     * @param $date
     * @return bool|int [xx小时xx分钟]
     */
    function computing_time($date)
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

if (!function_exists('array_merge_perfect')) {
    /**
     * 完善 array_merge
     * 将所有参数转换为数组，null、false 转换为空数组
     * @param array ...$args
     * @return array
     */
    function array_merge_perfect(...$args)
    {
        $fun = function ($value) {
            if ($value === false) {
                return array();
            }

            return (array)$value;
        };

        // 将所有参数都转换为 array 类型
        $arr = array_map($fun, $args);

        $newArray = array();
        foreach ($arr as $key => $value) {
            $newArray = array_merge($newArray, $value);
        }

        return $newArray;
    }
}

if (!function_exists('fibonacci')) {
    /**
     * 斐波那契数列
     * @param $n
     * @return int
     */
    function fibonacci($n)
    {
        if ($n == 0) {
            return 0;
        } elseif ($n == 1 || $n == 2) {
            return 1;
        }

        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}
