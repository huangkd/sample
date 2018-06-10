<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
//第10.4章 微博相关操作-删除微博
use App\Models\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*第10.4章 微博相关操作-删除微博
    public function __construct()
    {
        //
    }*/

    //第10.4章 微博相关操作-删除微博
    public function destroy(User $user, Status $status)
    {
        return $user->id === $status->user_id;
    }
}
