//第10.3章 显示微博-示例微博 生成微博假数据
//执行 ﻿$ php artisan make:seeder StatusesTableSeeder 生成
<?php

use Illuminate\Database\Seeder;
//第10.3章 显示微博-示例微博 生成微博假数据 使用 User 类和 Status 类
use App\Models\User;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //第10.3章 显示微博-示例微博 生成微博假数据 为前三个用户生成微博假数据
    public function run()
    {
        $user_ids = ['1','2','3'];
        $faker = app(Faker\Generator::class);

        $statuses = factory(Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
            $status->user_id = $faker->randomElement($user_ids);
        });

        Status::insert($statuses->toArray());
    }
}
