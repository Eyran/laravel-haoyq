<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFakerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faker_users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 20)->comment('姓名');
            $table->string('email', 50)->comment('邮箱');
            $table->tinyInteger('age')->comment('年龄');
            $table->char('city', 20)->comment('城市');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `faker_users` comment'测试用户表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faker_users');
    }
}
