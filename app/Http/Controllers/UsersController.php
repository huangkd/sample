<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//第7.3章 用户登录-注册后自动登录
use Auth;
//第9.2章 账户激活-发送邮件
use Mail;

class UsersController extends Controller
{
    //第8.3章 权限系统-必须先登录
    public function __construct()
    {
        $this->middleware('auth', [
            // 第9.2章 账户激活-激活功能
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
            // 第8.4章 列出所有用户-用户列表﻿
            //'except' => ['show', 'create', 'store', 'index']
            //'except' => ['show', 'create', 'store']
        ]);

        //第8.3章 权限系统-﻿注册与登录页面访问限制
        $this->middleware('guest', [
        'only' => ['create']
    ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        //【第10.3章 显示微博-获取微博
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('users.show', compact('user', 'statuses'));
        //第10.3章 显示微博-获取微博】

        //return view('users.show', compact('user')); 第10.3章 显示微博-获取微博
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //第9.2章 账户激活-发送邮件
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
        /*第9.2章 账户激活-发送邮件
        Auth::login($user); //7.3章
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
        */
    }

    // 第8.2章 更新用户-编辑表单
    public function edit(User $user)
    {
        // 第8.3章 权限系统-﻿用户只能编辑自己的资料
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    // 第8.2章 更新用户-编辑失败
    /*
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.show', $user->id);
    }*/

    // 第8.2章 更新用户-编辑成功
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);


        // 第8.3章 权限系统-﻿用户只能编辑自己的资料
        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }

    //第8.4章 列出所有用户-用户列表
    public function index()
    {
        //$users = User::all();
        $users =  User::paginate(10);
        return view('users.index', compact('users'));
    }

    //第8.5章，删除用户-Destroy动作，删除用户
    public function destroy(User $user)
    {
        //第8.5章，删除用户-Destroy动作 只允许已登录的管理员删除用户
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    //第9.2章 账户激活-发送邮件
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        // $from = 'aufree@yousails.com'; 第9.4章 在生产环境中发送邮件-历史遗留问题
        $name = 'Aufree';
        $to = $user->email;
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        /* 第9.4章 在生产环境中发送邮件-历史遗留问题
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
        */
        // 第9.4章 在生产环境中发送邮件-历史遗留问题
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }


    //第9.2章 账户激活-激活功能
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    //【第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
    // 第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面】
}
