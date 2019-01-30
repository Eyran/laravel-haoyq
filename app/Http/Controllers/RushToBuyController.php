<?php

/**
 * 秒杀控制器
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RushToBuyController extends Controller
{

    /**
     * 创建秒杀列表
     */
    public function createList()
    {
        $count = 30;
        $redisKey = 'goods_list';

        for ($i = 0; $i < $count; $i++) {

            if (Redis::llen($redisKey) >= $count) {
                break;
            }

            Redis::rpush($redisKey, $i);
        }
    }
}
