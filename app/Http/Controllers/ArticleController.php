<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category_description;

use App\Article_description;
use App\Http\Resources\Articles;
class ArticleController extends Controller
{
    public function getArticlesByCategoryId($slug){
        $this->language_id = 1;
        $this->slug = $slug;
        $category = Category_description::with(['category'=>function($query){
                $query->with(['article'=>function($query){
                    $query->with(['descriptions'=>function($query){
                        $query->where('language_id', $this->language_id);
                    }])->where('published',1);
                }]);
        }])->where('slug', $this->slug)->where('language_id', $this->language_id)->first();
        return new Articles($category);
    }
    public function getArticle($slug){
        $this->language_id = 1;
        $this->slug = $slug;
        $category = Article_description::with(['article'=>function($query){
            $query->where('published',1);
            }])->where('slug', $this->slug)->where('language_id', $this->language_id)->first();
        return new Articles($category);
    }
}
