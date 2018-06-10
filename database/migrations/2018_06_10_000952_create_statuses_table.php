<?php
// 第10.2章 微博模型-基本模型 执行 ﻿php artisan make:migration create_statuses_table --create="statuses" 生成
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            // 第10.2章 微博模型-基本模型 增加3个字段
            $table->text('content');
            $table->integer('user_id')->index();
            $table->index(['created_at']);

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
        Schema::dropIfExists('statuses');
    }
}
