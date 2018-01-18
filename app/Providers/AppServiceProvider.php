<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \view()->composer(['layouts.header','user.setting','user.index','user/message','layouts.menus'], function ($view) {
            $user = \Auth::user();
            $view->with('user',$user);
        });
        
        \view()->composer('layouts.umenu', function ($view) {
            $path = \Request::segment(2);
            $view->with('path',$path);
        });

        \view()->composer('layouts.hotpost',function($view){
            $hots = \App\Post::withCount('comments')->orderBy('comments_count','desc')->take(10)->get();    //本周热议
            $view->with('hots',$hots);
        });

        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
