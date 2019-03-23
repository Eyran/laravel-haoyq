<?php

namespace App\Listeners;

use App\Events\UserBrowse;
use Illuminate\Support\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class CreateUserIpLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 记录用户 IP
     * @param  UserBrowse $event
     * @return void
     */
    public function handle(UserBrowse $event)
    {
        $redis = Redis::connection('cache');
        $redisKey = 'user_ip:' . Carbon::today()->format('Y-m-d');

        $isExists = $redis->exists($redisKey);

        $redis->sadd($redisKey, $event->ip_addr);

        if (!$isExists) {
            // key 不存在，说明是当天第一次存储，设置过期时间三天
            $redis->expire($redisKey, 259200);
        }
    }
}
