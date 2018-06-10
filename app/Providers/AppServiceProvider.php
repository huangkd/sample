<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 第10.3章 显示微博-渲染微博 设置中国日期时间格式
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 第10.3章 显示微博-渲染微博 设置中国日期时间格式
        Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
