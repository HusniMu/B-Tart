<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_id', 'order_id', 'tgl_pengiriman', 'tanggal', 'pengiriman'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'order_id', 'id');
    }

    public function custom()
    {
        return $this->belongsTo(CustomOrder::class, 'order_id', 'id');
    }
}
