<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrowseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browse_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip_addr')->comment('ip 地址');
            $table->string('request_url', 20)->comment('请求 url');
            $table->char('city_name', 10)->comment('根据 ip 获取城市名称');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `browse_logs` comment'浏览记录表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('browse_logs');
    }
}
