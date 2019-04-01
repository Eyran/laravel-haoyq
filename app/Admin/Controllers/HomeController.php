<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

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
        $envs = [
            ['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],

        ];

        return view('admin::dashboard.environment', compact('envs'));
    }


}
