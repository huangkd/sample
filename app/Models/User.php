<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //第9.2章 账户激活-生成令牌
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function gravatar($size = '100')
    {
    $hash = md5(strtolower(trim($this->attributes['email'])));
    return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //【第9.3章 密码重设-邮件程序
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    //第10.2章 显示微博-微博模型
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    //第10.4章 微博相关操作-动态流原型 取出当前用户已经发布的所有微博，按产生日期倒序
    public function feed()
    {
        /* 第11.4章 ﻿动态流-动态流
        return $this->statuses()
            ->orderBy('created_at', 'desc');
        */
        //【第11.4章 ﻿动态流-动态流
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
            ->with('user')
            ->orderBy('created_at', 'desc');
        // 第11.4章 ﻿动态流-动态流】
    }
    //第11.2章 粉丝数据表-关注的人和粉丝
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    //第11.2章 粉丝数据表-关注的人和粉丝
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    //第11.2章 粉丝数据表-关注的人和粉丝 为当前用户（$this)，添加关注用户（集）（$user_ids)
    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    //第11.2章 粉丝数据表-关注的人和粉丝 取消当前用户（$this)的关注用户（集）（$user_ids)
    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    //第11.2章 粉丝数据表-关注的人和粉丝 ﻿﻿判断当前登录的用户 A($this) 是否关注了用户 B($user_id)
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
