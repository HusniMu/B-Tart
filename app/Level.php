<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name','harga'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function customOrder()
    {
        return $this->belongsToMany('App\CustomOrder')->withTimestamps();
    }
}
