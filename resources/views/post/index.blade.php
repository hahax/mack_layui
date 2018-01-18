@extends('layouts.main')

@section('content')
@include('layouts.menus')
<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md8">
      <div class="fly-panel">
        <div class="fly-panel-title fly-filter">
          <a>置顶</a>
          <a href="#signin" class="layui-hide-sm layui-show-xs-block fly-right" id="LAY_goSignin" style="color: #FF5722;">去签到</a>
        </div>
        <ul class="fly-list">
          @foreach($postTop as $top)
          <li>
            <a href="user/home.html" class="fly-avatar">
              <img src="{{ ($top->user->avatar !== '') ? $top->user->avatar : \App\User::DEFAVA }}" alt="{{$top->user->name}}">
            </a>
            <h2>
              <a class="layui-badge">动态</a>
              <a href="/posts/show/{{$top->id}}">{{$top->title}}</a>
            </h2>
            <div class="fly-list-info">
              <a href="/user/home/{{$top->user->id}}" link>
                <cite>{{$top->user->name}}</cite>
                <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                @if(\App\User::isSuperAdmin($top->user->id))
                  <i class="layui-badge fly-badge-vip layui-hide-xs">管理员</i>
                @endif
              </a>
              <span>{{$top->created_at->diffForHumans()}}</span>
              
              <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> 60</span>
              <span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>
              <span class="fly-list-nums"> 
                <i class="iconfont icon-pinglun1" title="回答"></i> {{$top->comments_count}}
              </span>
            </div>
            <div class="fly-list-badge">
                @if($top->rsuv == 1)
                    <span class="layui-badge layui-bg-red">精帖</span>
                @endif
            </div>
          </li>
          @endforeach
        </ul>
      </div>

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
        {{--<div style="text-align: center">--}}
          {{--<div class="laypage-main">--}}
            {{--{{$posts->links()}}--}}
          {{--</div>--}}
        {{--</div>--}}
          <div style="text-align: center">
            <div class="laypage-main">
              <a href="/posts/index" class="laypage-next">更多帖子</a>
            </div>
          </div>
      </div>
    </div>

    <div class="layui-col-md4">

      {{--<div class="fly-panel">--}}
        {{--<h3 class="fly-panel-title">温馨通道</h3>--}}
        {{--<ul class="fly-panel-main fly-list-static">--}}
          {{--<li>--}}
            {{--<a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<a href="http://fly.layui.com/jie/5366/" target="_blank">--}}
              {{--layui 常见问题的处理和实用干货集锦--}}
            {{--</a>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<a href="http://fly.layui.com/jie/5366/" target="_blank">--}}
              {{--layui 常见问题的处理和实用干货集锦--}}
            {{--</a>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>--}}
          {{--</li>--}}
        {{--</ul>--}}
      {{--</div>--}}


      {{--<div class="fly-panel fly-signin">--}}
        {{--<div class="fly-panel-title">--}}
          {{--签到--}}
          {{--<i class="fly-mid"></i> --}}
          {{--<a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>--}}
          {{--<i class="fly-mid"></i> --}}
          {{--<a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜<span class="layui-badge-dot"></span></a>--}}
          {{--<span class="fly-signin-days">已连续签到<cite>16</cite>天</span>--}}
        {{--</div>--}}
        {{--<div class="fly-panel-main fly-signin-main">--}}
          {{--<button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>--}}
          {{--<span>可获得<cite>5</cite>飞吻</span>--}}
          {{----}}
          {{--<!-- 已签到状态 -->--}}
          {{--<!----}}
          {{--<button class="layui-btn layui-btn-disabled">今日已签到</button>--}}
          {{--<span>获得了<cite>20</cite>飞吻</span>--}}
          {{---->--}}
        {{--</div>--}}
      {{--</div>--}}

      <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
        <h3 class="fly-panel-title" style="border-left: 4px solid #f63756;">最新会员</h3>
        <dl>
          @foreach($newUsers as $com)
            <dd>
              <a href="/user/home/{{$com->id}}">
                <img src="{{ ($com->avatar!=="") ? $com->avatar : \App\User::DEFAVA }}"><cite>{{$com->name}}</cite>
                <i>{{$com->created_at->diffForHumans()}}加入</i>
              </a>
            </dd>
          @endforeach
        </dl>
      </div>

      <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
        <h3 class="fly-panel-title">回贴周榜</h3>
        <dl>
          {{--<i class="layui-icon fly-loading">&#xe63d;</i>--}}
          @foreach($comms as $com)
          <dd>
            <a href="/user/home/{{$com->id}}">
              <img src="{{ ($com->avatar!=="") ? $com->avatar : \App\User::DEFAVA }}"><cite>{{$com->name}}</cite><i>{{$com->comments_count}}次回答</i>
            </a>
          </dd>
          @endforeach
        </dl>
      </div>

      @include("layouts.hotpost")
      <div class="fly-panel">
        <div class="fly-panel-title">
          这里可作为广告区域
        </div>
        <div class="fly-panel-main">
          <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
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