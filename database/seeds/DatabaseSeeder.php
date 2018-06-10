<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        //第10.3章 显示微博-示例微博 调用微博数据填充文件
        $this->call(StatusesTableSeeder::class);

        Model::reguard();
    }
}