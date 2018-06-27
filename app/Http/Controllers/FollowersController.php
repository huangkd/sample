<?php
//【第11.3章 ﻿关注用户的网页界面-﻿﻿关注功能的逻辑处理
// 由 ﻿$ php artisan make:controller FollowersController 生成框架

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//【第11.3章 ﻿关注用户的网页界面-﻿﻿关注功能的逻辑处理
use App\Http\Requests;
use App\Models\User;
use Auth;

// 第11.3章 ﻿关注用户的网页界面-﻿﻿关注功能的逻辑处理】
class FollowersController extends Controller
{
    //【第11.3章 ﻿关注用户的网页界面-﻿﻿关注功能的逻辑处理
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (!Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
    // 第11.3章 ﻿关注用户的网页界面-﻿﻿关注功能的逻辑处理】
}
