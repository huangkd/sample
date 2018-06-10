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
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }
}
