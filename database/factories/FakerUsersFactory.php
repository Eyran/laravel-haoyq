<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\FakerUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'age' => $faker->numberBetween(8, 80),// 数字在 8-80 之间随机
        'city' => $faker->city,
        'created_at' => $faker->dateTimeBetween('-3 year', '-1 year'),// 时间在 三年到一年 之间
        'updated_at' => $faker->dateTimeBetween('-1 year', '-5 month'),// 时间在 一年到五个月之间
    ];
});
