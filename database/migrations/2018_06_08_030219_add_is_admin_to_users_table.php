//第8.5章 删除用户-管理员 使用 php artisan make:migration add_is_admin_to_users_table --table=users 生成
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //第8.5章 删除用户-管理员 在 users 表中增加 is_admin 字段
            $table->boolean('is_admin')->default(false);
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
            //第8.5章 删除用户-管理员 在 users 表中删除 is_admin 字段
            $table->dropColumn('is_admin');
        });
    }
}