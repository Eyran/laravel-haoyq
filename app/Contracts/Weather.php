<?php
/**
 * Weather.php
 * 获取天气第三方 API 契约
 * Author: haoyq
 * Date: 2018/12/30
 */

interface Weather
{
    /**
     * 根据城市名称获取天气信息
     * @param $cityName
     * @return mixed
     */
    public function getWeather($cityName);
}