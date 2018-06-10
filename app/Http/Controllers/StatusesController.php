<?php
//第10.4章 微博相关的操作-访问控制
//﻿$ php artisan make:controller StatusesController 生成

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//【第10.4章 微博相关的操作-创建微博
use App\Http\Requests;
use App\Models\Status;
use Auth;
//第10.4章 微博相关的操作-创建微博】

class StatusesController extends Controller
{
    //第10.4章 微博相关的操作-访问控制 需要登录才能创建或删除微博
    public function __construct()
    {
        $this->middleware('auth');
    }

    //【第10.4章 微博相关的操作-创建微博
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        return redirect()->back();
    }
    //第10.4章 微博相关的操作-创建微博】

    //第10.4章 微博相关的操作-删除微博
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
