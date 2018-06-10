//第10.3章 显示微博-示例微博 生成微博假数据
//执行 php artisan make:factory StatusFactory 生成模板
<?php

use Faker\Generator as Faker;

//$factory->define(Model::class, function (Faker $faker) {
//第10.3章 显示微博-示例微博 生成微博假数据
$factory->define(App\Models\Status::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'content'    => $faker->text(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
