<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id', 'published', 'image'];

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function descriptions(){
        return $this->hasMany('App\Category_description');
    }

    public function article(){
        return $this->morphedByMany('App\Article', 'categoryable');
    }
}
