<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('author',function (){
            return Auth::user()->role === 'author';
        });

        Blade::if('admin',function (){
            return Auth::user()->role === 'admin';
        });

        Blade::if('isNotAuthor',function (){
            return Auth::user()->role !== 'author';
        });

        Blade::if('isTrashRoute',function (){
            return request()->url() !== route('post.trash');
        });

        View::composer(
            [
                'post.create',
                'post.edit',
                'client_template/right_sidebar',
            ], function ($view){
            $view->with('categories',Category::query()->latest('id')->get());
        });

        View::composer([
            'client_template/client_nav',
        ],function ($view){
            $view->with('user',Auth::user());
        });

        Blade::if('notAdmin',function (){
            return Auth::user()->role !== 'admin';
        });

    }
}
