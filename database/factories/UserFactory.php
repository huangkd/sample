//系统自动产生，与教程相比有点不同

<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {

    //﻿static $password; //第8.4章 列出所有用户-示例用户，但没有改变量
    /*第8.4章 列出所有用户-示例用户
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
    第8.4章 列出所有用户-示例用户 */
    $date_time = $faker->date . ' ' . $faker->time;
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        //第8.5章 删除用户-管理员，将字段 is_admin 设置为 false
        'is_admin' => false,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
