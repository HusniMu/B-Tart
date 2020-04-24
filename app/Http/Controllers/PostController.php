<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\Hiasan;
use App\Level;
use App\Topping;
use Carbon\Carbon;
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

        $tgl_sekarang = Carbon::now()->format('Y-m');
        $tgl_tambah = Carbon::now()->format('d');
        $randomPosts = Post::where('slug','!=',$slug)
                    ->published()
                    ->take(4)->inRandomOrder()->get();
        return view('post', compact('post', 'randomPosts','tgl_sekarang','tgl_tambah'));
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

    public function postByTopping($slug)
    {
        $posts = Topping::where('slug',$slug)->first()->posts->where('status',true);
        $topping = Topping::where('slug',$slug)->first();
        return view('topping',compact('topping','posts'));
    }

    public function postByLevel($slug)
    {
        $posts = Level::where('slug',$slug)->first()->posts->where('status',true);
        $level = Level::where('slug',$slug)->first();
        return view('level',compact('level','posts'));
    }

    public function postByHiasan($slug)
    {
        $posts = Hiasan::where('slug',$slug)->first()->posts->where('status',true);
        $hiasan = Hiasan::where('slug',$slug)->first();
        return view('hiasan',compact('hiasan','posts'));
    }

    public function category()
    {
        $categories = Category::all();
        return view('categories',compact('categories'));
    }
}
