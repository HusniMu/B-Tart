<?php

namespace App\Http\Controllers;

use App\CustomOrder;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $produk = Cart::instance('produk')->content();
        // $cusPro = Cart::instance('cusPro')->content();

        return view('cart.index',compact('produk'));
    }

    public function cusStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'harga' => 'nullable|numeric',
            'category' => 'required',
            'tags' => 'required',
            'toppings' => 'required',
            'level' => 'required|numeric',
            'body' => 'required',
            'lama' => 'numeric'
        ]);
        $image = $request->file('image');
        $currentDate = Carbon::now()->toDateString();
        $slug = \Str::slug($request->title) . '-' . $currentDate . '-' . uniqid();
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('custom')) {
                Storage::disk('public')->makeDirectory('custom');
            }

            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('custom/' . $imageName, $postImage);
        } else {
            $imageName = "default.png";
        }

        $post = new CustomOrder();
        $post->id = $request->id;
        $post->user_id = Auth::id();
        $post->title = ucwords($request->title);
        $post->slug = $slug;
        $post->harga = $request->harga;
        $post->image = $imageName;
        $post->body = $request->body;
        $post->lama = $request->lama;
        $post->harga = $request->harga;
        $post->save();

        $post->categories()->attach($request->category);
        $post->tags()->attach($request->tags);
        $post->toppings()->attach($request->toppings);
        $post->hiasans()->attach($request->hiasans);
        $post->levels()->attach($request->level);

        // foreach($post->tags as $tag){
        //     $harga_tmp = $tag->harga;
        //     $post->harga += $harga_tmp;
        // }
        // foreach($post->toppings as $topping){
        //     $harga_tmp = $topping->harga;
        //     $post->harga += $harga_tmp;
        // }
        // foreach($post->hiasans as $hiasan){
        //     $harga_tmp = $hiasan->harga;
        //     $post->harga += $harga_tmp;
        // }
        // foreach($post->levels as $level){
        //     $harga_tmp = $level->harga;
        //     $post->harga += $harga_tmp;
        // }


        $duplicate = \Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicate->isNotEmpty()){
            Toastr::error('Post is already on your cart.', 'Error');
            return back();
        }

        \Cart::instance('cusPro')->add($request->id, $request->title, 1, $request->harga)->associate('App\CustomOrder');
        Toastr::success('Post Successfully added to your cart.', 'Success');
        return back();
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


        \Cart::instance('produk')->add($request->id, $request->title, 1, $request->harga)->associate('App\Post');
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

        \Cart::instance('produk')->update($id,$request->quantity);
        Toastr::success('Cart Successfully updated.', 'Success');
        return response()->json(['success'=>true]);
    }

    public function destroy($id)
    {
        \Cart::instance('produk')->remove($id);
        Toastr::success('Post Successfully remove from your cart.', 'Success');
        return back();
    }

    public function destroyCus($id)
    {
        \Cart::instance('cusPro')->remove($id);
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
