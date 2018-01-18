<?php
// 用户模块
// 注册页面
Route::get('/register', 'RegisterController@index');
// 注册行为
Route::post('/register', 'RegisterController@register');
// 登陆页面
Route::get('/login', 'LoginController@index');
// 登陆行为
Route::post('/login', 'LoginController@login');
// 登出行为
Route::get('/logout', 'LoginController@logout');
// 个人设置页面
Route::get('/user/setting','UserController@setting');
// 个人设置操作
Route::post('/user/me/setting','UserController@settingStore');
// 个人中心首页
Route::get('/user/home/{user}','UserController@home');
// 用户中心
Route::get('/user/index/{user}','UserController@index');
// 我的消息
Route::get('/user/message','UserController@message');
// 激活邮箱
Route::get('/user/activate','UserController@activate');
// 修改个人设置
Route::post('/user/dosetting','UserController@doSetting');
// ajax上传图片
Route::post('/user/uploadImg','UserController@uploadImg');

Route::get('/','PostController@index');
// 文章列表
Route::get('/posts','PostController@index');

Route::get('/posts/index','PostController@postIndex');
// 文章详情
Route::get('/posts/show/{post}','PostController@show');
// 创建文章
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');
// 编辑文章
Route::get('/posts/{post}/edit','PostController@edit');
Route::put('/posts/{post}','PostController@update');
// 删除文章
Route::get('posts/{post}/delete','PostController@destroy');
Route::get('posts/{comment}/deleteComment','PostController@destroyComment');
// 图片上传
Route::post('/posts/image/upload', 'PostController@imageUpload');
Route::post('/post/uploadImg', 'PostController@upload');
// 发表回复
Route::post('/posts/comment','PostController@comment');
// 置顶
Route::get('posts/top/{post}/{type}','PostController@doTop');
// 精华
Route::get('posts/rsuv/{post}/{type}','PostController@doRsuv');
// 验证码图片
Route::get('pic/cap/{tmp}','LoginController@captcha');

Route::get('/posts/collection/{post}','PostController@doColl');