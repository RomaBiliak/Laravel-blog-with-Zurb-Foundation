<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Articles;
use App\Http\Resources\ArticlesCollection as ArticlesResource;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->language_id = 1;
       /* $articles = Article::with(['descriptions'=>function ($query) {
            $query->where('language_id', $this->language_id);
        }])->whereHas('descriptions', function ($query) {
            //$query->where('language_id', $this->language_id);
            $query->where('published', 1)->orderBy('created_at', 'DESC')->offset(0)->limit(6);
        })->get();*/

        $articles = Article::with(['descriptions'=>function ($query) {
            $query->where('language_id', $this->language_id);
        }])->where('published', 1)->orderBy('created_at', 'DESC')->offset(0)->limit(6)->get();

       return new Articles($articles);

    }
}
