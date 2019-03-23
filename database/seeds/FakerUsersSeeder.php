<?php

use Illuminate\Database\Seeder;

class FakerUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\FakerUser::class)->times(1000)->make()->each(function ($model) {
            // 数据入库
            $model->save();
        });
    }
}
