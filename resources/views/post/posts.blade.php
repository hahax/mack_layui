@extends("layouts.main")

@section("content")
    @include('layouts.menus')
<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">
            <div class="fly-panel" style="margin-bottom: 0;">

                <div class="fly-panel-title fly-filter">
                    <a href="" class="layui-this">综合</a>
                    <span class="fly-mid"></span>
                    <a href="">未结</a>
                    <span class="fly-mid"></span>
                    <a href="">已结</a>
                    <span class="fly-mid"></span>
                    <a href="">精华</a>
                    <span class="fly-filter-right layui-hide-xs">
            <a href="" class="layui-this">按最新</a>
            <span class="fly-mid"></span>
            <a href="">按热议</a>
          </span>
                </div>

                <ul class="fly-list">
                    @foreach($posts as $post)
                        <li>
                            <a href="/user/home/{{$post->user->id}}" class="fly-avatar">
                                <img src="{{ ($post->user->avatar!=="") ? $post->user->avatar : \App\User::DEFAVA }}" alt="{{$post->user->name}}">
                            </a>
                            <h2>
                                <a class="layui-badge">分享</a>
                                <a href="/posts/show/{{$post->id}}">{{$post->title}}</a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="/user/home/{{$post->user->id}}" link>
                                    <cite>{{$post->user->name}}</cite>
                                    {{--<i class="iconfont icon-renzheng" title="认证信息：XXX"></i>--}}
                                    @if(\App\User::isSuperAdmin($post->user->id))
                                        <i class="layui-badge fly-badge-vip layui-hide-xs">管理员</i>
                                    @endif
                                </a>
                                <span>{{$post->created_at->diffForHumans()}}</span>

                                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> 60</span>
                                <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                                <span class="fly-list-nums">
                  <i class="iconfont icon-pinglun1" title="回答"></i> {{$post->comments_count}}
                </span>
                            </div>
                            <div class="fly-list-badge">
                                @if($post->rsuv == 1)
                                    <span class="layui-badge layui-bg-red">精帖</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- <div class="fly-none">没有相关数据</div> -->
                <div style="text-align: center">
                    <div class="laypage-main">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            @include("layouts.hotpost")

            <div class="fly-panel">
                <div class="fly-panel-title">
                    这里可作为广告区域
                </div>
                <div class="fly-panel-main">
                    <a href="" target="_blank" class="fly-zanzhu" style="background-color: #393D49;">虚席以待</a>
                </div>
            </div>

            <div class="fly-panel fly-link">
                <h3 class="fly-panel-title">友情链接</h3>
                <dl class="fly-panel-main">
                    <dd><a href="http://www.layui.com/" target="_blank">layui</a><dd>
                    <dd><a href="http://layim.layui.com/" target="_blank">WebIM</a><dd>
                    <dd><a href="http://layer.layui.com/" target="_blank">layer</a><dd>
                    <dd><a href="http://www.layui.com/laydate/" target="_blank">layDate</a><dd>
                    <dd><a href="mailto:xianxin@layui-inc.com?subject=%E7%94%B3%E8%AF%B7Fly%E7%A4%BE%E5%8C%BA%E5%8F%8B%E9%93%BE" class="fly-link">申请友链</a><dd>
                </dl>
            </div>

        </div>
    </div>
</div>
@endsection