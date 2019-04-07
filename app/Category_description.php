<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_description extends Model
{
    protected $fillable = ['category_id', 'language_id', 'title', 'slug', 'description_short', 'description', 'meta_title', 'meta_description', 'meta_keyword'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Category'/*, 'category_id', 'id'*/);
    }

}
