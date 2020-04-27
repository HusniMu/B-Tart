<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        \Cart::add($request->id, $request->title, 1, $request->harga)->associate('App\Post');
        Toastr::success('Post Successfully added to your cart.', 'Success');
        return view('cart.index');
    }

    public function destroy($id)
    {
        \Cart::remove($id);
        Toastr::success('Post Successfully remove from your cart.', 'Success');
        return back();
    }
}
