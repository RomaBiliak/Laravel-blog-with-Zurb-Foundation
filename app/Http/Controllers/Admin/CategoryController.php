<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Category_description;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.categories.index', [

            'categories'=>Category::with(['descriptions'=>function ($query) {
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
        return view('admin.categories.create',[
            'category'=>[],
            'category_descriptions'=>[],
            'languages'=>Language::all(),
            'categories'=>Category::with(['descriptions'=>function ($query) {//всі записи де категорія має певну айдішку мови
                $query->where('language_id', 1);
            }, 'children'])->whereHas('descriptions', function ($query) {//всі записи де категорія має певну айдішку мови для запиту відношення
                $query->where('language_id', 1);
            })->where('parent_id','0')->get(),
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
        $category_id = Category::create($request->all())->id;
        $description =[];
        foreach($request->all()['data'] as $data){
            $data['category_id'] = $category_id;
            $description[] = $data;
        }
        Category_description::insert($description);
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $descriptions = [];
        foreach (Category_description::where('category_id', $category->id)->get() as  $description){
            $descriptions[$description->language_id] = $description;
        }
        return view('admin.categories.edit',[
            'category'=>$category,
            'image'=>$category->image,
            'category_descriptions'=>$descriptions,
            'languages'=>Language::all(),
            'categories'=>Category::with(['descriptions'=>function ($query) {//всі записи де категорія має певну айдішку мови
                $query->where('language_id', 1);
            }, 'children'])->whereHas('descriptions', function ($query) {//всі записи де категорія має певну айдішку мови для запиту відношення
                $query->where('language_id', 1);
            })->where('parent_id','0')->get(),
            'delimiter'=>''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, Category $category)
    {
        $request->validate();
        $category->update($request->toArray());
        Category_description::where('category_id',$category->id)->delete();
        Category_description::insert($request->all()['data']);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category_description::where('category_id',$category->id)->delete();
        $category->delete();
        return redirect()->route('admin.category.index');
    }

}
