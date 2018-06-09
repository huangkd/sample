<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/* 第8.3章 权限系统-用户只能编辑自己的资料
执行 ﻿php artisan make:policy UserPolicy 自动生成的代码

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
}
*/

/* 第8.3章 权限系统-用户只能编辑自己的资料
修改后的代码
*/

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //第8.5章 删除用户-﻿destroy 动作
    public function destroy(User $currentUser, User $user)
    {
        // 只有管理员才能删除不是自己的用户
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
