<dl class="fly-panel fly-list-one">
    <dt class="fly-panel-title">本周热议</dt>
    @if(count($hots)>0)
        @foreach($hots as $hot)
            <dd>
                <a href="/posts/show/{{$hot->id}}">{{$hot->title}}</a>
                <span><i class="iconfont icon-pinglun1"></i> {{$hot->comments_count}}</span>
            </dd>
        @endforeach
    @else
        <div class="fly-none">没有相关数据</div>
    @endif
</dl>