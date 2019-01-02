<?php
/**
 * Xinzhi.php
 * 心知天气 API 实现天气契约
 * Author: haoyq
 * Date: 2018/12/30
 */

namespace App\Service\Weather;

use App\Contracts\Weather;

class Xinzhi implements Weather
{
    public function getWeather($cityName)
    {
        $url = $this->getUrl($cityName);
        $jsonData = curl_request($url);
        $arrayData = json_decode($jsonData, true);

        if (isset($arrayData['status_code']) || !$arrayData) {
            return '获取天气失败';
        }

        return $arrayData['results'][0]['location']['name'] . '现在天气' . $arrayData['results'][0]['now']['text'] . '，气温 ' . $arrayData['results'][0]['now']['temperature'] . ' 度。';
    }

    /**
     * 根据文档修改
     * https://github.com/seniverse/seniverse-api-demos/blob/master/php/demo.php
     * @param $cityName
     * @return string
     */
    protected function getUrl($cityName)
    {
        // 心知天气接口调用凭据
        $key = env('XINZHI_API'); // 测试用 key，请更换成您自己的 Key
        $uid = env('XINZHI_UID'); // 测试用 用户 ID，请更换成您自己的用户 ID
// 参数
        $api = 'https://api.seniverse.com/v3/weather/now.json'; // 接口地址
        $location = $cityName; // 城市名称。除拼音外，还可以使用 v3 id、汉语等形式
// 生成签名。文档：https://www.seniverse.com/doc#sign
        $param = [
            'ts' => time(),
            'ttl' => 300,
            'uid' => $uid,
        ];
        $sig_data = http_build_query($param); // http_build_query 会自动进行 url 编码
// 使用 HMAC-SHA1 方式，以 API 密钥（key）对上一步生成的参数字符串（raw）进行加密，然后 base64 编码
        $sig = base64_encode(hash_hmac('sha1', $sig_data, $key, TRUE));
// 拼接 url 中的 get 参数。文档：https://www.seniverse.com/doc#daily
        $param['sig'] = $sig; // 签名
        $param['location'] = $location;
        $param['start'] = 0; // 开始日期。0 = 今天天气
        $param['days'] = 1; // 查询天数，1 = 只查一天
// 构造url
        $url = $api . '?' . http_build_query($param);
        return $url;
    }
}