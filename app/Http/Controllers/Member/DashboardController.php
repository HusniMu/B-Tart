<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', Auth::user()->id)->get();
        $favorites = $user->favorite_posts;
        return view('member.dashboard',compact('comments','favorites'));
    }
}
