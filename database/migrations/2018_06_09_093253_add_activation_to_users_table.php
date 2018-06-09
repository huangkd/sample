// 第9.2章 账户激活-添加字段 由命令行 ﻿php artisan make:migration add_activation_to_users_table --table=users
// 自动生成
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 第9.2章 账户激活-添加字段 给出 UP 需要增加的两个字段定义
            $table->string('activation_token')->nullable();
            $table->boolean('activated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 第9.2章 账户激活-添加字段 给出 DOWN 需要删除的两个字段定义
            $table->dropColumn('activation_token');
            $table->dropColumn('activated');
        });
    }
}
