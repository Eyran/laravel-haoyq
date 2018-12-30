<?php

namespace App\Http\Controllers;

use App\Contracts\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        return $weather->getWeather($request->input('city', 'beijing'));
    }

    /**
     * 测试专用
     */
    public function test()
    {
        return abort(404);
    }
}
