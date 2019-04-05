<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BrowseLog;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('laravel-haoyq')
            ->description('控制面板')
//            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append($this->dailyStatistics());
                });

                $row->column(8, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                /*$row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });*/
            });
    }

    /**
     * 每日信息统计
     */
    protected function dailyStatistics()
    {
        $today = today()->format('Y-m-d');
        $infos = [
            ['name' => '今日访问 IP 总数', 'value' => Redis::sCard('user_ip:' . $today)],
            ['name' => '今日访问 URL 总数', 'value' => BrowseLog::whereDate('created_at', $today)->count()],
            [
                'name' => '今日访问最多 URL',
                'value' => $this->getRequestCount($today),
            ]

        ];

        return view('laravel-admin/info', compact('infos'));
    }

    /**
     * 获取今天访问最多 URL
     * @param $date
     * @return string
     */
    protected function getRequestCount($date)
    {
        $count = BrowseLog::selectRaw('count(id) as count, request_url')
            ->whereDate('created_at', $date)
            ->groupBy('request_url')
            ->orderBy('count', 'DESC')
            ->first();

        if (!$count) {
            return '';
        }

        return $count->request_url.' ('.$count->count.')';
    }


}
