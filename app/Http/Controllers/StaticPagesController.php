<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//【第10.4章 微博相关操作-动态流原型
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Status;
use Auth;
//第10.4章 微博相关操作-动态流原型】

class StaticPagesController extends Controller
{
    public function home()
    {
        // return view('static_pages/home'); 第10.4章 微博相关操作-动态流原型

        //【第10.4章 微博相关操作-动态流原型 如果当前用户登录状态，分页读取和显示用户发表的微博
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('static_pages/home', compact('feed_items'));
        //第10.4章 微博相关操作-动态流原型】
    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }
}
