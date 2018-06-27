<!--第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面-->
@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>{{ $title }}</h1>
        <ul class="users">
            @foreach ($users as $user)
                <li>
                    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
                    <a href="{{ route('users.show', $user->id )}}" class="username">{{ $user->name }}</a>
                </li>
            @endforeach
        </ul>

        {!! $users->render() !!}
    </div>
@stop