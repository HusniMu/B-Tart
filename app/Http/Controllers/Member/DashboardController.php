<?php

namespace App\Http\Controllers\Member;

use App\Comment;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        // $comments = Comment::where('user_id', Auth::user()->id)->get();
        // $favorites = $user->favorite_posts;
        $transactions = Transaction::with([
            'details', 'post', 'custom', 'user'
        ])->where('users_id',$user)->get();

        return view('member.dashboard',compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = Transaction::with([
            'details', 'post', 'custom', 'user'
        ])->findOrFail($id);

        foreach($transaction->details as $details){
            $order_id = $details->order_id;
            $jumlah = $details->jumlah;
        }

        return view('member.transaction-detail', compact('transaction','order_id', 'jumlah'));
    }

    public function wishlist()
    {
        $user = Auth::user();
        // $comments = Comment::where('user_id', Auth::user()->id)->get();
        $favorites = $user->favorite_posts;
        return view('member.wishlist',compact('favorites'));
    }
}
