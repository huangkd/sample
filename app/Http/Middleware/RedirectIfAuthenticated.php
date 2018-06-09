<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //第8.3 权限系统-﻿注册与登录页面访问限制
            session()->flash('info', '您已登录，无需再次操作。');
            return redirect('/');
            //第8.3 权限系统-﻿注册与登录页面访问限制
            //return redirect('/home');
        }

        return $next($request);
    }
}
