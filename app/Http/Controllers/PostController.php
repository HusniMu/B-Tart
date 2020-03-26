<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()
                    ->published()
                    ->paginate(6);
        return view('posts',compact('posts'));
    }

    public function details($slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->first();

        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        $randomPosts = Post::where('slug','!=',$slug)
                    ->published()
                    ->take(3)->inRandomOrder()->get();
        return view('post', compact('post', 'randomPosts'));
    }

    public function postByCategory($slug)
    {
        $posts = Category::where('slug',$slug)->first()->posts->where('status',true);
        $category = Category::where('slug',$slug)->first();
        return view('category',compact('category','posts'));
    }

    public function postByTag($slug)
    {
        $posts = Tag::where('slug',$slug)->first()->posts->where('status',true);
        $tag = Tag::where('slug',$slug)->first();
        return view('tag',compact('tag','posts'));
    }

    public function category()
    {
        $categories = Category::all();
        return view('categories',compact('categories'));
    }
}
