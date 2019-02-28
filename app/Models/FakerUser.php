<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FakerUser extends Model
{
    public static function labels()
    {
        return [
            'id' => '序号',
            'name' => '姓名',
            'email' => '邮箱',
            'age' => '年龄',
            'city' => '城市',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
