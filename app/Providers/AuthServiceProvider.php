<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate; 第10.4章 微博相关操作-动态流原型
use Illuminate\Contracts\Auth\Access\Gate as GateContract; // 第10.4章 微博相关操作-动态流原型
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // 第8.3章 权限系统-用户只能编辑自己的资料
        \App\Models\User::class  => \App\Policies\UserPolicy::class,
        \App\Models\Status::class  => \App\Policies\StatusPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    /*【第10.4章 微博相关操作-动态流原型
    public function boot()
    {
        $this->registerPolicies();
    }
    第10.4章 微博相关操作-动态流原型 */
    //第10.4章 微博相关操作-动态流原型
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
