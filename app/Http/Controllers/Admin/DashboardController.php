<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\User;
use App\Comment;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $popular_posts = Post::published()
                    ->withCount('comments')
                    ->withCount('favorite_to_users')
                    ->orderBy('view_count','desc')
                    ->orderBy('comments_count','desc')
                    ->orderBy('favorite_to_users_count','desc')
                    ->take(5)->get();
        $all_views = Post::sum('view_count');
        $user_count = User::where('role_id',3)->count();
        $new_users_today = User::where('role_id',3)
                        ->whereDate('created_at',Carbon::today())->count();
        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();
        return view('admin.dashboard',compact('posts','popular_posts','all_views','user_count','new_users_today','category_count','tag_count'));
    }
}
