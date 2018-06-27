<!--第11.3章 ﻿关注用户的网页界面-﻿『关注的人』列表页面和『粉丝』列表页面-->
<div class="stats">
    <a href="{{ route('users.followings', $user->id) }}">
        <strong id="following" class="stat">
            {{ count($user->followings) }}
        </strong>
        关注
    </a>
    <a href="{{ route('users.followers', $user->id) }}">
        <strong id="followers" class="stat">
            {{ count($user->followers) }}
        </strong>
        粉丝
    </a>
    <a href="{{ route('users.show', $user->id) }}">
        <strong id="statuses" class="stat">
            {{ $user->statuses()->count() }}
        </strong>
        微博
    </a>
</div>
