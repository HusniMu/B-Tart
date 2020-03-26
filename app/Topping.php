<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = ['name','harga'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
