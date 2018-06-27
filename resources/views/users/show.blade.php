@extends('layouts.default')
@section('title', $user->name)
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <div class="col-md-offset-2 col-md-8">
                    <section class="user_info">
                        @include('shared._user_info', ['user' => $user])
                    </section>
                    <!-- 第11.3章 ﻿关注用户的网页界面-﻿﻿关注表单, 关注状态-->
                    <section class="stats">
                        @include('shared._stats', ['user' => $user])
                    </section>
                </div>
            </div>
            <!-- 第10.3章 显示微博-渲染微博-->
            <div class="col-md-12">
                <!-- 第11.3章 ﻿关注用户的网页界面-﻿﻿关注表单, 关注状态-->
                @if (Auth::check())
                    @include('users._follow_form')
                @endif
                @if (count($statuses) > 0)
                    <ol class="statuses">
                        @foreach ($statuses as $status)
                            @include('statuses._status')
                        @endforeach
                    </ol>
                    {!! $statuses->render() !!}
                @endif
            </div>
        </div>
    </div>
@stop