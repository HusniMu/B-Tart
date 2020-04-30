<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SaveForLaterController extends Controller
{
    public function destroy($id)
    {
        \Cart::instance('saveForLater')->remove($id);
        Toastr::success('Post Successfully remove from save for later.', 'Success');
        return back();
    }

    public function moveToCart($id)
    {
        $item = \Cart::instance('saveForLater')->get($id);
        \Cart::instance('saveForLater')->remove($id);

        $duplicate = \Cart::instance('default')->search(function($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplicate->isNotEmpty()){
            Toastr::error('Post is already on your cart.', 'Error');
            return redirect('/cart');
        }

        // $userId = Auth::user()->id;
        // \Cart::store($userId);
        // \Cart::instance('wishlist')->store($userId);

        \Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Post');
        Toastr::success('Post Successfully added to your cart.', 'Success');
        return back();
    }
}
