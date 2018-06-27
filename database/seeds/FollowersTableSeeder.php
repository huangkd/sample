<?php
// 第11.3章 关注用户的网页界面 由 ﻿$ php artisan make:seeder FollowersTableSeeder 生成
use Illuminate\Database\Seeder;
// 第11.3章 关注用户的网页界面
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //【第11.3章 关注用户的网页界面-示例数据
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 获取去除掉 ID 为 1 的所有用户 ID 数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // 关注除了 1 号用户以外的所有用户
        $user->follow($follower_ids);

        // 除了 1 号用户以外的所有用户都来关注 1 号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
        //第11.3章 关注用户的网页界面-示例数据】
    }
}
