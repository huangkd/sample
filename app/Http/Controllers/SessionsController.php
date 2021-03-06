<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    //第8.3章 权限系统-﻿注册与登录页面访问限制
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        //if (Auth::attempt($credentials)) 第7.5章
        if (Auth::attempt($credentials, $request->has('remember'))) {
            //第9.2章 账户激活-﻿登录时检查是否已激活
            if(Auth::user()->activated) {
                session()->flash('success', '欢迎回来！');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }

            /*第9.2章 账户激活-﻿登录时检查是否已激活
            session()->flash('success', '欢迎回来！');
            // 第8.3章 权限系统-友好的转向
            return redirect()->intended(route('users.show', [Auth::user()]));
            // 第8.3章 权限系统-友好的转向
            // return redirect()->route('users.show', [Auth::user()]);
            */
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }
        //} 第7.5章

        // return; 第7.5章
    }

    // 7.4章
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}