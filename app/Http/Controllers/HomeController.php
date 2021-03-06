<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        // $posts = Post::latest()->take(6)->get();
        // $posts = Post::where('status', true)
        //     ->latest()
        //     ->take(6)
        //     ->get();
        return view('welcome', compact('categories', 'banners'));
    }

    public function about()
    {
        return view('about-us');
    }

    public function howto()
    {
        return view('how-to');
    }

    public function faq()
    {
        return view('faq');
    }

    public function contact()
    {
        return view('contact-us');
    }
}
