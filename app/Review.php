<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    //Creates a one-to-many relationship between users and reviews
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
