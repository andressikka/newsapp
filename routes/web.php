<?php

use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\ArticleController;
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

Route::get('/', 'ArticleController@fetchNews')->name('newsPage');

// Route::get('/admin', 'AdminArticleController@index');
// Route::post('/admin', 'AdminArticleController@store');
// Route::get('/news', 'ArticleController@fetchNews');
Route::get('/articles', 'AdminArticleController@fetchArticles');

// Костыль
Route::get('/article/{id}', 'ArticleController@showArticle')->name('article');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function()
{
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Route::resource('/', 'AdminArticleController');
});

// нужно поставить в самый низ, иначе ларавел будет думать, что запросы на /admin/login будут выполнятся из AdminArticleController
Route::resource('/admin', 'AdminArticleController');
Route::resource('/comment_section', 'CommentController');
// Route::resources([
//     'admin' => AdminArticleController::class
// ]);