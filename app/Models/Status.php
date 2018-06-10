<?php
//第10.2章 微博模型-基本模型 执行 ﻿$ php artisan migrate 生成
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //第10.4章 微博相关操作-创建微博 设置微博内容字段 content 可以批量更新
    protected $fillable = ['content'];
    //第10.2章 微博模型-基本模型 建立与用户的关联关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
