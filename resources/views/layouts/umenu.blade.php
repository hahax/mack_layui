<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
    <li class="layui-nav-item @if($path == 'home') layui-this @endif">
        <a href="/user/home/{{$user->id}}">
            <i class="layui-icon">&#xe609;</i> 我的主页
        </a>
    </li>
    <li class="layui-nav-item @if($path == 'index') layui-this @endif">
        <a href="/user/index/{{$user->id}}">
            <i class="layui-icon">&#xe612;</i> 我的帖子
        </a>
    </li>
    <li class="layui-nav-item @if($path == 'setting' || $path == 'activate') layui-this @endif">
        <a href="/user/setting">
            <i class="layui-icon">&#xe620;</i> 基本设置
        </a>
    </li>
    <li class="layui-nav-item @if($path == 'message') layui-this @endif">
        <a href="/user/message">
            <i class="layui-icon">&#xe611;</i> 我的消息
        </a>
    </li>
</ul>