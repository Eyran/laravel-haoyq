<?php
/**
 * Helpers.php
 * 自定义函数
 * Author: haoyq
 * Date: 2018/12/8
 */

use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use GuzzleHttp\Client;
use Zhuzhichao\IpLocationZh\Ip;
use Illuminate\Support\Facades\Request;

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

if (!function_exists('insert_sort')) {
    /**
     * 插入排序
     * @param array $arr
     * @return array
     */
    function insert_sort(array $arr)
    {
        $count = count($arr);

        if ($count < 2) {
            return $arr;
        }

        for ($i = 1; $i < $count; $i++) {
            $temp = $arr[$i];
            for ($k = $i - 1; $k >= 0; $k--) {
                if ($temp < $arr[$k]) {
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $temp;
                }
            }
        }

        return $arr;
    }
}

if (!function_exists('computing_time')) {
    /**
     * 计算未来某时与现在时间差
     * @param $date
     * @return null|int [xx小时xx分钟]
     */
    function computing_time($date)
    {
        $time = strtotime($date);
        if (!$time || $time < time()) {
            return null;
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

if (!function_exists('get_file_ext')) {
    /**
     * 获取文件扩展名
     * @param $file
     * @return mixed
     */
    function get_file_ext($file)
    {
        $arr = explode('.', $file);
        return end($arr);
    }
}

if (!function_exists('get_file_ext_1')) {
    /**
     * 获取文件扩展名，另外两种方法
     * @param $file
     * @return bool|string
     */
    function get_file_ext_1($file)
    {
//        return substr($file, strrpos($file, '.') + 1);
        $arr = pathinfo($file);
        return $arr['extension'];
    }
}

if (!function_exists('print_qr')) {
    /**
     * 获取二维码图片
     * 更多配置及使用可查看 https://www.jianshu.com/p/765b1fc37b62
     * @param $content
     * @param int $size
     * @return string|void [二维码图片]
     */
    function print_qr($content, $size = 200)
    {
        $qr = new BaconQrCodeGenerator();
        return $qr->size($size)->generate($content);
    }
}

if (!function_exists('computing_sum')) {
    /**
     * 计算两个整数区间的总和
     * @param int $min
     * @param int $max
     * @return float|int
     */
    function computing_sum(int $min, int $max)
    {
        if ($min > $max || $min == $max) {
            return 0;
        }

        $arr = range($min, $max);
        return array_sum($arr);
    }
}

if (!function_exists('get_email_name')) {
    /**
     * 获取邮箱名称
     * @param $email
     * @return null|string
     */
    function get_email_name($email)
    {
        if (!is_email($email)) {
            return null;
        }

//        return substr($email, 0, strpos($email, '@'));
        $arr = explode('@', $email);
        return array_shift($arr);
    }
}

if (!function_exists('monkey_king')) {
    /**
     * 猴子选大王
     * 共有 m 个猴子，按照 1、2、3...m 排序。从第一位开始数，每到 n 个，该猴子被淘汰，最后剩下的为猴王。
     * monkey_king(range(1, m), n)
     * @param array $arr
     * @param int $n
     * @param int $k
     * @return array
     */
    function monkey_king(array $arr, int $n, int $k = 0)
    {
        if (count($arr) <= 1) {
            return array_pop($arr);
        }

        foreach ($arr as $key => $value) {
            $k++;
            if ($k % $n == 0) {
                unset($arr[$key]);
                $k = 0;
            }
        }

        return monkey_king($arr, $n, $k);
    }
}

if (!function_exists('curl_request')) {
    /**
     * 封装 curl 函数
     * 根据 https://laravel-china.org/articles/2768/easy-to-use-curl-class 修改
     * @param $url
     * @param bool $params
     * @param bool $isPost
     * @param bool $isHttps
     * @return mixed|null
     */
    function curl_request($url, $params = false, $isPost = false, $isHttps = false)
    {
//        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($isHttps) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($isPost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            return null;
        }

//        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);

        return $response;
    }
}

if (!function_exists('send_request')) {
    /**
     * 封装 GuzzleHttp\Client，发送请求
     * @param $uri
     * @param array $params
     * @param bool $isPost
     * @return null|\Psr\Http\Message\StreamInterface
     */
    function send_request($uri, array $params = [], bool $isPost = false)
    {
        $client = new Client();

        if (!empty($params)) {
            if ($isPost) {
                $response = $client->post($uri, ['form_params' => $params]);
            } else {
                $response = $client->get($uri, ['query' => $params]);
            }
        } else {
            $response = $client->request(($isPost ? 'POST' : 'GET'), $uri);
        }

        if (!in_array($response->getStatusCode(), [200])) {
            return null;
        }

        return $response->getBody();
    }
}

if (!function_exists('is_json')) {
    /**
     * 判断是否为 json
     * @param string $string
     * @return bool
     */
    function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('get_pinyin')) {
    /**
     * 获取拼音
     * @param string $string
     * @return string
     */
    function get_pinyin(string $string)
    {
        $arr = pinyin($string);
        return implode('', $arr);
    }
}

if (!function_exists('get_city_by_ip')) {
    /**
     * 根据访问 ip 获取城市名称
     * @param bool $isPinyin
     * @param string $default
     * @return string
     */
    function get_city_by_ip(bool $isPinyin = false, string $default = '北京', string $ip = '')
    {
        $ip_addr = $ip ?: Request::getClientIp();
        $arr = Ip::find($ip_addr);
        $city = !empty($arr[2]) ? $arr[2] : $default;

        if ($isPinyin) {
            return get_pinyin($city);
        } else {
            return $city;
        }
    }
}

if (!function_exists('is_email')) {
    /**
     * 判断是否为 email
     * @param $email
     * @return bool
     */
    function is_email($email)
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('similar_text_perfect')) {
    /**
     * 计算两个字符串的相似度
     * 封装 similar_text 函数
     * @param string $string
     * @param string $string1
     * @param int $precision [小数点位数]
     * @param bool $isSymbol [是否有 %]
     * @return float|string
     */
    function similar_text_perfect(string $string, string $string1, int $precision = 2, bool $isSymbol = true)
    {
        similar_text($string, $string1, $temp);

        if ($isSymbol) {
            return round($temp, $precision) . '%';
        } else {
            return round($temp, $precision);
        }
    }
}

if (!function_exists('strrev_perfect')) {
    /**
     * 字符串翻转，包括汉字
     * @param string $string
     * @return null|string
     */
    function strrev_perfect(string $string)
    {
        if (!mb_check_encoding($string, 'UTF-8')) {
            return null;
        }

        $count = mb_strlen($string);

        for ($i = 0; $i < $count; $i++) {
            $arr[] = mb_substr($string, $i, 1, 'UTF-8');
        }

        krsort($arr);
        return implode('', $arr);
    }
}

if (!function_exists('is_local')) {
    /**
     * 是否为本地环境
     * @param string $local
     * @return bool
     */
    function is_local(string $local = 'local')
    {
        return env('APP_ENV') == $local;
    }
}
