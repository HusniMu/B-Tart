<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // protected $fillable = ['title', 'image', 'body', 'status', 'is_approved'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // jenis kue
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    // rasa kue
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    // topping kue
    public function toppings()
    {
        return $this->belongsToMany('App\Topping')->withTimestamps();
    }
    // level kue
    public function levels()
    {
        return $this->belongsToMany('App\Level')->withTimestamps();
    }
    // hiasan kue
    public function hiasans()
    {
        return $this->belongsToMany('App\Hiasan')->withTimestamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopePublished($query)
    {
        return $query->where('status',1);
    }
}
