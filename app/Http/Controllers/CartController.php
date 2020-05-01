<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        $duplicate = \Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicate->isNotEmpty()){
            Toastr::error('Post is already on your cart.', 'Error');
            return back();
        }

        // $userId = Auth::user()->id;
        // \Cart::store($userId);
        // \Cart::instance('wishlist')->store($userId);

        \Cart::add($request->id, $request->title, 1, $request->harga)->associate('App\Post');
        Toastr::success('Post Successfully added to your cart.', 'Success');
        return back();
    }

    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'stok' => 'required|numeric|between:1,5'
        // ]);

        // if ($validator->fails()) {
        //     // session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
        //     Toastr::info('We currently do not have enough items in stock.', 'info');
        //     return response()->json(['success' => false], 400);
        // }

        // if ($request->quantity > $request->productQuantity) {
        //     // session()->flash('errors', collect(['We currently do not have enough items in stock.']));
        //     Toastr::info('We currently do not have enough items in stock.', 'info');
        //     return response()->json(['success' => false], 400);
        // }

        \Cart::update($id,$request->quantity);
        Toastr::success('Cart Successfully updated.', 'Success');
        return response()->json(['success'=>true]);
    }

    public function destroy($id)
    {
        \Cart::remove($id);
        Toastr::success('Post Successfully remove from your cart.', 'Success');
        return back();
    }

    public function saveForLater($id)
    {
        $item = \Cart::get($id);
        \Cart::remove($id);
        \Cart::instance('saveForLater')->add($item->id, $item->name,1, $item->price)->associate('App\Post');
        Toastr::success('Post has benn saved for later.', 'Success');
        return redirect('/cart');
    }
}
