<?php

namespace App;

use App\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'post_id', 'custom_order_id', 'users_id',
        'transaction_total',
        'nama', 'email', 'alamat_lengkap', 'zip', 'no_hp',
        'transaction_status'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function custom()
    {
        return $this->belongsTo(CustomOrder::class, 'custom_order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


}
