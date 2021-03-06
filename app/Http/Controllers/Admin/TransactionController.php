<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use App\Hiasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;
use App\Topping;
use App\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with([
            'details', 'post', 'custom', 'user'
        ])->get();


        return view('admin.transaction.index', compact('transactions'));
        // return dd($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $toppings = Topping::all();
        $hiasans = Hiasan::all();
        $levels = Level::all();
        return view('admin.post.create', compact('categories', 'tags', 'toppings', 'hiasans', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'harga' => 'nullable|numeric',
            'category' => 'required',
            'tags' => 'required',
            'toppings' => 'required',
            'level' => 'required|numeric',
            'body' => 'required',
            'lama' => 'required|numeric',
            'stok' => 'nullable|numeric'
        ]);
        $image = $request->file('image');
        $currentDate = Carbon::now()->toDateString();
        $slug = \Str::slug($request->title) . '-' . $currentDate . '-' . uniqid();
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImage);
        } else {
            $imageName = "default.png";
        }

        $post = new Post();
        $post->users_id = Auth::id();
        $post->title = ucwords($request->title);
        $post->slug = $slug;
        $post->harga = $request->harga;
        $post->image = $imageName;
        $post->body = $request->body;
        // if (isset($request->status)) {
        //     $post->status = true;
        // } else {
        //     $post->status = false;
        // }
        $post->lama = $request->lama;
        $post->stok = $request->stok;
        if($post->stok == 0){
            if(!isset($request->status) || isset($request->status)){
                $post->status = false;
            }
        } else {
            if(isset($request->status)){
                $post->status = true;
            } else{
                $post->status = false;
            }
        }
        $post->save();

        $post->categories()->attach($request->category);
        $post->tags()->attach($request->tags);
        $post->toppings()->attach($request->toppings);
        $post->hiasans()->attach($request->hiasans);
        $post->levels()->attach($request->level);

        $post->harga = 0;
        foreach($post->tags as $tag){
            $harga_tmp = $tag->harga;
            $post->harga += $harga_tmp;
        }
        foreach($post->toppings as $topping){
            $harga_tmp = $topping->harga;
            $post->harga += $harga_tmp;
        }
        foreach($post->hiasans as $hiasan){
            $harga_tmp = $hiasan->harga;
            $post->harga += $harga_tmp;
        }
        foreach($post->levels as $level){
            $harga_tmp = $level->harga;
            $post->harga += $harga_tmp;
        }

        $post->save();

        // $subscribers = Subscriber::all();
        // if ($post->status == true) {
        //     foreach ($subscribers as $subscriber) {
        //         Notification::route('mail', $subscriber->email)
        //             ->notify(new NewPostNotify($post));
        //     }
        // }

        Toastr::success('Post Successfully Saved', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with([
            'details', 'post', 'custom', 'user'
        ])->findOrFail($id);

        foreach($transaction->details as $details){
            $order_id = $details->order_id;
            $jumlah = $details->jumlah;
        }

        return view('admin.transaction.show', compact('transaction','order_id', 'jumlah'));
        // return dd(($transaction->post_id));
        // return dd(json_decode($order_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('admin.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'transaction_status' => 'required|string|in:IN_CART,PENDING,SUCCESS,CANCEL,FAILED'
        ]);

        $transaction->transaction_status = $request->transaction_status;
        $transaction->save();

        Toastr::success('Transaction Successfully Updated', 'Success');
        return redirect()->route('admin.transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        Toastr::success('Transaction Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
