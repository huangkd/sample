<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    //第8.3章 权限系统-必须先登录
    public function __construct()
    {
        $this->middleware('auth', [
            // 第8.4章 列出所有用户-用户列表﻿
            'except' => ['show', 'create', 'store', 'index']
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
        return view('users.show', compact('user'));
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

        Auth::login($user); //7.3章
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
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

}
