<?php
/**
 * Holiday.php
 * 第三方接口判断节日
 * Author: haoyq
 * Date: 2019/02/04
 */

namespace App\Contracts;

interface Holiday
{
    public function isHoliday($date);
}