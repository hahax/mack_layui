@extends('layouts.main')

@section('content')
@include('layouts.menus')
<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md8 content detail">
      <div class="fly-panel detail-box">
        <h1>{{$post->title}}</h1>
        <div class="fly-detail-info">
          <!-- <span class="layui-badge">审核中</span> -->
          <span class="layui-badge layui-bg-green fly-detail-column">动态</span>
          
          {{--<span class="layui-badge" style="background-color: #999;">未结</span>--}}
          <!-- <span class="layui-badge" style="background-color: #5FB878;">已结</span> -->
            @if($post->top == 1)
            <span class="layui-badge layui-bg-black">置顶</span>
            @endif
            @if($post->rsuv == 1)
            <span class="layui-badge layui-bg-red">精帖</span>
            @endif
          
          <div class="fly-admin-box" data-id="123">
            @if(Auth::check())
              @if(Auth::user()->can('delete',$post) || Gate::allows('admin',$post))
              <a href="/posts/{{$post->id}}/delete"><span class="layui-btn layui-btn-xs jie-admin" type="del">删除</span></a>
              @endif
            @endif

            @if(Gate::allows('admin'))
                @if($post->top == 1)
                <a href="/posts/top/{{$post->id}}/0">
                    <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span>
                </a>
                @else
                <a href="/posts/top/{{$post->id}}/1"><span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="1">置顶</span></a>
                @endif

                @if($post->rsuv == 1)
                <a href="/posts/rsuv/{{$post->id}}/0">
                    <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span>
                </a>
                @else
                <a href="/posts/rsuv/{{$post->id}}/1"><span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="1">加精</span></a>
                @endif
            @endif
          </div>
          <span class="fly-list-nums"> 
            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{$num->comments_count}}</a>
            <i class="iconfont" title="人气">&#xe60b;</i>
            {{--@if($post->view_count == 0)--}}
            {{----}}
            {{--{{$post->view_count}}--}}
            {{--@endif--}}
          </span>
        </div>
        <div class="detail-about">
          <a class="fly-avatar" href="../user/home.html">
            <img src="{{ ($post->user->avatar!=="") ? $post->user->avatar : \App\User::DEFAVA }}" alt="{{$post->user->name}}">
          </a>
          <div class="fly-detail-user">
            <a href="../user/home.html" class="fly-link">
              <cite>{{$post->user->name}}</cite>
              <i class="iconfont icon-renzheng" title="认证信息："></i>
              @if(\App\User::isSuperAdmin($post->user->id))
                <i class="layui-badge fly-badge-vip layui-hide-xs">管理员</i>
              @endif
            </a>
            <span>{{ $post->created_at->diffForHumans() }}</span>
          </div>
          <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
            <span style="padding-right: 10px; color: #FF7200">悬赏：60飞吻</span>
            @if(Auth::check())  
              @if(Auth::user()->can('update',$post))
                <a href="/posts/{{$post->id}}/edit"><span class="layui-btn layui-btn-xs jie-admin" type="edit">编辑此贴</span></a>
              @endif
                @if($post->collection(\Auth::id())->exists())
                  <span class="layui-btn layui-btn-xs jie-admin" type="edit">已收藏</span>
                  @else
                  <a href="/posts/collection/{{$post->id}}"><span class="layui-btn layui-btn-xs jie-admin" type="edit">收藏此贴</span></a>
                @endif
            @endif
          </div>
        </div>
        <div class="detail-body photos">
            {{--  {{$post->content}}  --}}
            {!! $post->content !!}
        </div>
      </div>

      <div class="fly-panel detail-box" id="flyReply">
        <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
          <legend>回帖</legend>
        </fieldset>

        <ul class="jieda" id="jieda">
          @if(count($post->comments)>0)
            @foreach($post->comments as $comment)
              <li data-id="111" class="jieda-daan">
                <a name="item-1111111111"></a>
                <div class="detail-about detail-about-reply">
                  <a class="fly-avatar" href="">
                    <img src="{{$comment->user->avatar}}" alt=" ">
                  </a>
                  <div class="fly-detail-user">
                    <a href="" class="fly-link">
                      <cite>{{$comment->user->name}}</cite>
                      <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                      <i class="layui-badge fly-badge-vip">VIP3</i>              
                    </a>
                    
                    <span>(楼主)</span>
                    <!--
                    <span style="color:#5FB878">(管理员)</span>
                    <span style="color:#FF9E3F">（社区之光）</span>
                    <span style="color:#999">（该号已被封）</span>
                    -->
                  </div>

                  <div class="detail-hits">
                    <span>{{$comment->created_at}}</span>
                  </div>

                  <i class="iconfont icon-caina" title="最佳答案"></i>
                </div>
                <div class="detail-body jieda-body photos">
                  <p>{!! EndaEditor::MarkDecode($comment->content) !!}</p>
                </div>
                <div class="jieda-reply">
                  <span class="jieda-zan zanok" type="zan">
                    <i class="iconfont icon-zan"></i>
                    <em>66</em>
                  </span>
                  <span type="reply">
                    <i class="iconfont icon-svgmoban53"></i>
                    回复
                  </span>
                  <div class="jieda-admin">
                    @can('update',$comment)
                      <span type="edit">编辑</span>
                    @endcan
                    @can('delete',$comment)
                        <a href="/posts/{{$comment->id}}/deleteComment"><span type="del">删除</span></a>
                    @endcan
                    <span class="jieda-accept" type="accept">采纳</span>
                  </div>
                </div>
              </li>
            @endforeach
            <!-- 无数据时 -->
              @else  
              <li class="fly-none">消灭零回复</li> 
            @endif
        </ul>
        
        <div class="layui-form layui-form-pane">
          @if(Auth::check())
          <form action="/posts/comment" method="post">
            {{csrf_field()}}
            <input type="hidden" name="post_id" value="{{$post->id}}"/>
            <div class="layui-form-item layui-form-text">
              <a name="comment"></a>
              <div class="layui-input-block">
                <div class="editor">
                  <textarea id='myEditor' name="content" required placeholder="详细描述" lay-verify="required">{{ old('content') }}</textarea>
                </div>
              </div>
            </div>
            @include('layouts.error')
            <div class="layui-form-item">
              <input type="hidden" name="jid" value="123">
              <button class="layui-btn" lay-filter="*" type="submit">提交回复</button>
            </div>
          </form>
          @else
            <button class="layui-btn layui-disabled" lay-filter="*">请登录后提交回复</button>
          @endif
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
          <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
        </div>
      </div>

      <div class="fly-panel" style="padding: 20px 0; text-align: center;">
        <img src="/images/weixin.jpg" style="max-width: 100%;" alt="layui">
        <p style="position: relative; color: #666;">微信扫码关注 layui 公众号</p>
      </div>

    </div>
  </div>
</div>
@include('layouts.markdown')
@endsection