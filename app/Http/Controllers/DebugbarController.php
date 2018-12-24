<?php
/**
 * DebugbarController.php
 * Debugbar
 * Author: haoyq
 * Date: 2018/12/24
 */

namespace App\Http\Controllers;

use App\Libraries\Deque;
use Debugbar;

class DebugbarController extends Controller
{
    /**
     * 显示视图
     */
    public function debugbarView()
    {
        return view('qr');
    }

    /**
     * 添加消息
     */
    public function debugbarLog()
    {
        Debugbar::info(new Deque(range(1, 10)));
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');
        return view('qr');
    }
}