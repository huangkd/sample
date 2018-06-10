<!-- //第10.4章 微博相关操作-动态流原型 -->
@if (count($feed_items))
    <ol class="statuses">
        @foreach ($feed_items as $status)
            @include('statuses._status', ['user' => $status->user])
        @endforeach
        {!! $feed_items->render() !!}
    </ol>
@endif