<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function setting()
    {
        return view('user.setting');
        // return view('user.imgup');
    }

    public function settingStore()
    {

    }

    public function index(User $user)
    {
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(11);
        $num = \App\User::withCount(['posts'])->find($user->id);
        return view('user.index',compact('posts','num'));
    }

    public function home(User $user)
    {
        $posts = $user->posts()->withCount("comments")->orderBy('created_at','desc')->take(15)->get();
        $comments = $user->comments()->take(5)->get();
        return view('user.home',compact('user','posts','comments'));
    }

    public function message()
    {
        return view('user.message');
    }

    public function activate()
    {
        return view('user.activate');
    }

    public function doSetting(Request $request)
    {
        $uid = \Auth::user();
        $user = \App\User::find($uid->id);
        $name = request('name');
        if($name !== $user->name)
        {
            if(\App\User::where('name',$name)->count()>0)
            {
                return back()->withErrors('昵称已存在');
            }
            $user->name = $name;
        }
        $user->gender = request('gender');
        $user->autograph = request('autograph');
        $user->save();
        return redirect('/user/setting');
    }

    public function uploadImg(Request $request)
    {
        if ($request->ajax() && \Auth::check()) {
            $user = \Auth::user();
            // dd($request->file('file'));
            $file = $request->file('file');
            // 第一个参数代表目录, 第二个参数代表我上方自己定义的一个存储媒介
            $path = '/uploads/'.$file->store('avatars', 'uploads');
            $user->avatar = $path;
            $user->save();
            return response()->json(array('path' => $path));
        }
        // 注意看下方模版代码
        return view('user/setting');
    }
}
