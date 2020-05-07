<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Level;
use App\Hiasan;
use App\Topping;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $toppings = Topping::all();
        $hiasans = Hiasan::all();
        $levels = Level::all();
        $lama = 7;
        $tgl_sekarang = Carbon::now()->format('Y-m');
        $tgl_tambah = Carbon::now()->format('d');
        $id = Carbon::now()->format('YmdHis');
        $title = "custom-".$id;
        $harga = 150000;

        $randomPosts = Post::published()->take(4)->inRandomOrder()->get();
        return view('customOrder',compact('categories','tags','toppings','hiasans','levels','lama','tgl_sekarang','tgl_tambah','randomPosts','id','title','harga'));
    }
}
