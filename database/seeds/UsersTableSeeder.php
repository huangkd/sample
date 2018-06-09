<!-- 运行 ﻿$ php artisan make:seeder UsersTableSeeder 产生
第8.4 列出所有用户-数据填充 -->
<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1); //定位到第一个用户
        $user->name = 'Aufree';
        $user->email = 'aufree@yousails.com';
        $user->password = bcrypt('password');
        // 第8.5章 删除用户-管理员 将第一个用户指定为管理员
        $user->is_admin = true;
        $user->save();
    }
}

//第8.4 列出所有用户-数据填充
