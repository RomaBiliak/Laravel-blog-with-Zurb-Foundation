<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['published', 'image'];

    public function descriptions(){
        return $this->hasMany('App\Article_description');
    }
    public function categories(){
        return $this->morphToMany('App\Category', 'categoryable');
    }
}
