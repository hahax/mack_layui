@extends('layouts.main')

@section('content')
<div class="layui-container fly-marginTop fly-user-main">
    @include('layouts.umenu')

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>


    <div class="fly-panel fly-panel-user" pad20>
        <!--
<div class="fly-msg" style="margin-top: 15px;">
    您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
</div>
-->
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-jie" lay-id="index" class="layui-this">我发的帖（<span>{{$num->posts_count}}</span>）</li>
                <li data-type="collection" data-url="/collection/find/" lay-id="collection">我收藏的帖（<span>16</span>）</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <ul class="mine-view jie-row">
                        @if(count($posts)>0)
                            @foreach($posts as $post)
                                <li>
                                    <a class="jie-title" href="/posts/show/{{$post->id}}" target="_blank">{{$post->title}}</a>
                                    <i>{{$post->created_at->diffForHumans()}}</i>
                                    @if(Auth::user()->can('update',$post))
                                        <a class="mine-edit" href="/posts/{{$post->id}}/edit">编辑</a>
                                    @endif
                                    <em>661阅/10答</em>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    {{--  <div id="LAY_page"></div>  --}}
                    <div style="text-align: center">
                        <div class="laypage-main">
                            @if(count($posts)>0)
                                {{$posts->links()}}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="layui-tab-item">
                    <ul class="mine-view jie-row">
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>收藏于23小时前</i> </li>
                    </ul>
                    <div id="LAY_page1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection