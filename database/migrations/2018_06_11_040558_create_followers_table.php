<?php
// 第11.2章 粉丝数据表-粉丝表的构建 执行 ﻿$ php artisan make:migration create_followers_table --create="followers" 生成
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            //【第11.2章 粉丝数据表-粉丝表的构建
            $table->integer('user_id')->index();
            $table->integer('follower_id')->index();
            //第11.2章 粉丝数据表-粉丝表的构建】
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
