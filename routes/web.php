<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function() {
    Auth::routes();
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);
    Route::resource('/language', 'LanguageController', ['as'=>'admin']);

    Route::match(['get', 'post'], '/image', 'ImageController@ajaxImage', ['as'=>'admin']);
    Route::delete('/image-delete', 'ImageController@deleteImage', ['as'=>'admin']);

});




Route::get('/', 'HomeController@index')->name('index');
Route::get('categoy/{slug}', 'ArticleController@getArticlesByCategoryId')->name('category');
Route::get('article/{slug}', 'ArticleController@getArticle')->name('article');



