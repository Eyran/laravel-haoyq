<?php
/**
 * Hefeng.php
 * 和风天气 API 实现天气契约
 * Author: haoyq
 * Date: 2018/12/31
 */

namespace App\Service\Weather;

use App\Contracts\Weather;

class Hefeng implements Weather
{
    public function getWeather($cityName)
    {
        $param = ['key' => env('HEFENG_KEY'), 'location' => $cityName];
        $url = 'https://free-api.heweather.net/s6/weather/now';

        $jsonData = curl_request($url, $param, false, true);
        $arrayData = json_decode($jsonData, true);

        if ($arrayData['HeWeather6'][0]['status'] != 'ok' || !$arrayData) {
            return '获取天气失败';
        }

        return $arrayData['HeWeather6'][0]['basic']['location'] . '现在天气' . $arrayData['HeWeather6'][0]['now']['cond_txt'] . '，气温 ' . $arrayData['HeWeather6'][0]['now']['tmp'] . ' 度。';
    }
}