<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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

        return computingTime($date);
    }

    /**
     * 测试专用
     */
    public function test()
    {
        return abort(404);
    }
}
