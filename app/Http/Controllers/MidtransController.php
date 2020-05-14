<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Mail\TransactionSuccess;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;


class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');


        // buat instance midtrans notification
        $notification = new Notification();

        $order  = explode('-', $notification->order_id);

        // assign ke variabel
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        // $order_id = 'MIDTRANS-'.$notification->order_id;
        $order_id = $order[1];

        // cari transaksi berdasarkan order id
        $transaction = Transaction::findOrFail($order_id);

        // handle notifikasi
        if($status == 'capture'){
            if($tupe == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->transaction_status = 'CHALLENGE';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } else if($status == 'settlement'){
            $transaction->transaction_status = 'CHALLENGE';
        } else if($status == 'PENDING'){
            $transaction->transaction_status = 'PENDING';
        } else if($status == 'expire'){
            $transaction->transaction_status = 'EXPIRED';
        } else if($status == 'cancel'){
            $transaction->transaction_status = 'FAILED';
        }

        // simpan transaksi
        $transaction->save();

        // kirim email
        if($transaction){
            if($status == 'capture' && $fraud =='accept'){
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction);
                );
            } else if($status == 'settlement'){
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction);
                );
            } else if($status == 'success'){
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction);
                );
            } else if($status == 'capture' && $fraud =='challenge'){
                return response()->json([
                    'meta' => [
                        'code' =>200,
                        'message' => 'Midtrans Payment Challenge',
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' =>200,
                        'message' => 'Midtrans Payment not Settlement',
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' =>200,
                    'message' => 'Midtrans notification success',
                ]
            ]);
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('unfinish');
    }

    public function failedRedirect(Request $request)
    {
        return view('failed');
    }
}
