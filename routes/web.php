<?php

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//第9.2章 账户激活-激活路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//【第9.3章 密码重设
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//第9.3章 密码重设】

//第10.4章 微博相关的操作-微博相关的操作 使用 only 指定生成 store 和 destroy 两个动作的路由
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//【第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
//第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面】

//【第11.3章 ﻿关注用户的网页界面-﻿﻿关注表单, 添加路由
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
// 第11.3章 ﻿关注用户的网页界面-﻿﻿关注表单, 添加路由】