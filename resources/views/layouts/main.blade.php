<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{config('blog.name')}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="{{config('blog.keywords')}}">
  <meta name="description" content="{{config('blog.description')}}">
  <link rel="stylesheet" href="/layui/css/layui.css">
  <link rel="stylesheet" href="/css/global.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')
 
<script src="/layui/layui.js"></script>
<script>
layui.config({
  version: "3.0.0"
  ,base: '/mods/' //这里实际使用时，建议改成绝对路径
}).extend({
  fly: 'index'
}).use('fly');
</script>

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_30088308'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "w.cnzz.com/c.php%3Fid%3D30088308' type='text/javascript'%3E%3C/script%3E"));</script>

</body>
</html>