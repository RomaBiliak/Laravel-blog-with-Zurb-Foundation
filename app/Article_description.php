<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article_description extends Model
{
    protected $fillable = ['article_id', 'language_id', 'title', 'slug', 'description_short', 'description', 'meta_title', 'meta_description', 'meta_keyword'];
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
