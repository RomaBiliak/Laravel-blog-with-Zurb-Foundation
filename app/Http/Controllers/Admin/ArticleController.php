<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Article_description;
use App\Language;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Article::with(['descriptions'=>function ($query) {
            $query->where('language_id', 1);
        }])->whereHas('descriptions', function ($query) {
            $query->where('language_id', 1);
        })->paginate(10));
        return view('admin.articles.index', [
            'articles'=>Article::with(['descriptions'=>function ($query) {
                $query->where('language_id', 1);
            }])->whereHas('descriptions', function ($query) {
                $query->where('language_id', 1);
            })->paginate(10)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create',[
            'article'=>[],
            'article_descriptions'=>[],
            'languages'=>Language::all(),
            'categories'=>$this->getCategories(),
            'delimiter'=>''
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $request->validate();
        $article = Article::create($request->all());
        $article_id = $article->id;
        $description =[];
        foreach($request->all()['data'] as $data){
            $data['article_id'] = $article_id;
            $description[] = $data;
        }
        Article_description::insert($description);
        if($request->input('categories')){
            $article->categories()->attach($request->input('categories'));
        }
        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {

        $descriptions = [];
        foreach (Article_description::where('article_id', $article->id)->get() as  $description){
            $descriptions[$description->language_id] = $description;
        }
        return view('admin.articles.edit',[
            'article'=>$article,
            'image'=>$article->image,
            'article_descriptions'=>$descriptions,
            'languages'=>Language::all(),
            'categories'=>$this->getCategories(),
            'delimiter'=>''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, Article $article)
    {
        $request->validated();
        $article->update($request->toArray());
        Article_description::where('article_id',$article->id)->delete();
        Article_description::insert($request->all()['data']);
        $article->categories()->detach();
        if($request->input('categories')){
            $article->categories()->attach($request->input('categories'));
        }
        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article_description::where('article_id',$article->id)->delete();
        $article->delete();
        return redirect()->route('admin.article.index');
    }

    protected function getCategories()
    {
        return Category::with( ['descriptions'=>function ($query) {
            $query->where('language_id', 1);
        }, 'children'])->whereHas('descriptions', function ($query) {
            $query->where('language_id', 1);
        })->where('parent_id', 0)->get();
    }
}
