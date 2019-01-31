<?php

/**
 * 秒杀控制器
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        for ($i = 1; $i <= $count; $i++) {

            // 测试用，防止数据错误
            if (Redis::llen($redisKey) >= $count) {
                break;
            }

            Redis::rpush($redisKey, $i);
        }
    }

    /**
     * 秒杀
     */
    public function buy()
    {
        // 随机用户名，无意义，仅做标记
        $username = Hash::make(now());

        if ($goodsId = Redis::lpop('goods_list')) {
            // 购买成功
            Redis::hset('buy_success', $goodsId, $username);
        } else {
            // 购买失败
            Redis::incr('buy_fail');
        }
    }

    /**
     * 展示购买成功的用户
     * @return mixed
     */
    public function buySuccess()
    {
        return Redis::hgetall('buy_success');
    }
}
