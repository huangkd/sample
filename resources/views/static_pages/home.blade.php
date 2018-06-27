@extends('layouts.default')

@section('content')
    <!-- 【第10.4章 微博相关的操作-创建微博 -->
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <!--【第10.4章 微博相关的操作-﻿动态流原型 -->
                <h3>微博列表</h3>
                @include('shared._feed')
                <!--第10.4章 微博相关的操作-﻿动态流原型】 -->
                </div>
                <aside class="col-md-4">
                    <section class="user_info">
                        @include('shared._user_info', ['user' => Auth::user()])
                    </section>
                    <!--第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面-->
                    <section class="stats">
                        @include('shared._stats', ['user' => Auth::user()])
                    </section>
                </aside>
        </div>
    @else <!-- 第10.4章 微博相关的操作-创建微博】 -->
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p class="lead">
                <!-- 第10.4章 微博相关的操作-创建微博
                你现在所看到的是 <a href="https://laravel-china.org/courses/laravel-essential-training-5.1">Laravel 入门教程</a> 的项目主页。
                -->
                你现在所看到的是 <a href="https://laravel-china.org/laravel-tutorial/5.1">Laravel 入门教程</a> 的项目主页。
            </p>
            <p>
                一切，将从这里开始。
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            </p>
        </div>
    @endif <!-- 第10.4章 微博相关的操作-创建微博 -->
@stop