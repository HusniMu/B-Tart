<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image', 'body'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function customOrder()
    {
        return $this->belongsToMany('App\CustomOrder')->withTimestamps();
    }
}
