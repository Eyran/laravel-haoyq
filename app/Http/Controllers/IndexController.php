<?php

namespace App\Http\Controllers;

use App\Contracts\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    /**
     * 获取煮粥定时时间
     * @param Request $request
     * @return bool|int
     */
    public function getCookTime(Request $request)
    {
        // 默认是明天早上七点
        $date = $request->input('date', Carbon::tomorrow()->hour(7)->minute(0)->toDateTimeString());

        return computing_time($date);
    }

    /**
     * 获取天气情况
     * @param Request $request
     * @param Weather $weather
     * @return mixed
     */
    public function getWeather(Request $request, Weather $weather)
    {
        return $weather->getWeather($request->input('city', get_city_by_ip(true)));
    }

    /**
     * 测试 Redis 的存储
     */
    public function testRedis()
    {
        // Redis 门面
        Redis::setex('facades', 30, 'i am facades');
        // Cache
        Cache::put('cache', 'i am cache', now()->addMinute(30));
        // 因为 Cache 默认是 Redis，所有和上面语句相同
        // Cache::store('redis')->put('cache', now(), now()->addMinute(30));
        // 使用 Redis 指定连接
        $redis = Redis::connection('session');
        $redis->setex('facades_connection', 30, 'i am facades_connection');
    }

    /**
     * 测试专用
     */
    public function test()
    {
        // 返回 404
        return abort(404);
    }
}
