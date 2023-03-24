<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::search()->with(['category','user'])->latest('id')->paginate(5)->withQueryString();
//        return $posts;
        return view('page.index',compact('posts'));
    }

    public function detail($slug)
    {
        $recentPosts = Post::query()->latest('id')->limit(5)->get();
        $post = Post::with(['photos','user','category'])->where('slug',$slug)->first();
//        return $post;
        return view('page.detail',compact('post','recentPosts'));
    }

    public function author($name)
    {
        $user = User::with(['posts'])->where('name',$name)->first();
        $posts = $user->posts()->search()->where('user_id',$user->id)->latest('id')->paginate(7)->withQueryString();
//        return $user;
        return view('page.author',compact('user','posts'));
    }

    public function postByCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->where('category_id',$category->id)->latest('id')->paginate(7)->withQueryString();
//        return [$category,$posts];
        return view('page.category',compact('category','posts'));

    }
}
