<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Comment;
use App\Events\PostViewCount;
use App\Post;
use App\User;
use EndaEditor;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    const modelCacheExpires = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->withCount("comments")->take(11)->get();
        $comms = User::withCount("comments")->orderBy("comments_count","desc")->take(12)->get();    //回帖周榜
        $newUsers = User::orderBy("created_at","desc")->take(12)->get();    //新进用户

        $postTop = Post::where('top',1)->withCount('comments')->orderBy('created_at','desc')->take(4)->get();
        return view('post.index',compact('posts','comms','postTop','newUsers'));
        // return view('index',compact('posts'));
    }

    public function postIndex()
    {
        $posts = Post::orderBy('created_at','desc')->withCount("comments")->paginate(8);
        return view('post.posts',compact('posts'));
    }

    public function doColl(Post $post)
    {
        $params = array_merge(['post_id'=>$post->id],['user_id'=>\Auth::id()]);
        \App\Collection::create($params);
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'vercode' => 'required|integer',
        ]);
        if(request('vercode') !== '2')
        {
            return back()->withErrors("验证信息不符")->withInput();
        }
        $params = array_merge(request(['title','content']),['user_id'=>\Auth::id()]);
        Post::create($params);
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,Request $request)
    {
        $id = $post->id;

        //Redis缓存中没有该post,则从数据库中取值,并存入Redis中,该键值key='post:cache'.$id生命时间10分钟
        $cache = Cache::remember('post:cache:'.$id,self::modelCacheExpires,function() use ($id){
            return Post::whereId($id)->first();
        });
        //获取客户端IP
        $ip = $request->ip();

        //触发浏览量计数器事件
        event(new PostViewCount($cache,$ip));

        $post->content = EndaEditor::MarkDecode($post->content);
        $num = Post::withCount(['comments'])->find($post->id);
//        dd($num);
        return view('post.show',compact('post','num'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $this->validate(request(),[
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'vercode' => 'required|integer',
        ]);
        if(request('vercode') !== '2')
        {
            return back()->withErrors("验证信息不符")->withInput();
        }
        $post->update(request(['title','content']));
        return redirect("/posts/show/{$post->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return back();
    }

    public function upload(){
        // path 为 public 下面目录，比如我的图片上传到 public/uploads 那么这个参数你传uploads 就行了
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }

    public function comment()
    {
        $this->validate(request(),[
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|min:4',
        ]);

        $user_id = \Auth::id();
        $params = array_merge(
            request(['post_id','content']),
            compact('user_id')
        );

        \App\Comment::create($params);
        return back();
    }

    public function doTop(Post $post,$type)
    {
        $user = new User();
        if($user->isSuperAdmin())
        {
            $post->top = $type;
            $post->save();
            return back();
        }else
        {
            abort(401,'权限错误');
        }
    }

    public function doRsuv(Post $post,$type)
    {
        $user = new User();
        if($user->isSuperAdmin())
        {
            $post->rsuv = $type;
            $post->save();
            return back();
        }else
        {
            abort(401,'权限错误');
        }
    }
}
