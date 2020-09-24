<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin_view.admin');
});


Route::resource('/admin', 'AdminArticleController');

// Route::get('/admin', 'AdminArticleController@index');
// Route::post('/admin', 'AdminArticleController@store');
Route::get('/news', 'ArticleController@fetchNews');
Route::get('/articles', 'AdminArticleController@fetchArticles');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
