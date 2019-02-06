<?php
/**
 * Goseek.php
 * 实现 Holiday 契约
 * Author: haoyq
 * Date: 2019/02/05
 */

namespace App\Service\Holiday;

use App\Contracts\Holiday;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSystemInfo;


class Goseek implements Holiday
{
    /**
     * @param $date
     * @return bool
     */
    public function isHoliday($date)
    {
        $jsonData = send_request('http://api.goseek.cn/Tools/holiday', ['date' => $date]);

        if (!is_json($jsonData)) {
            // 发送邮件
            Mail::to(env('ADMIN_EMAIL'))->send(new SendSystemInfo('获取节日信息失败'));
            return false;
        }

        $arr = json_decode($jsonData, true);

        return $arr['data'] == 2 ? true : false;
    }
}