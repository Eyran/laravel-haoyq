<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrowseLog extends Model
{
    public static function labels()
    {
        return [
            'id' => '序号',
            'ip_addr' => 'IP 地址',
            'request_url' => '请求 URL',
            'city_name' => '城市',
            'created_at' => '访问时间',
            'updated_at' => '更新时间',
        ];
    }
}
