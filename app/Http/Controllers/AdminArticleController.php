<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArticle;
use Illuminate\Support\Facades\DB;

class AdminArticleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_view.admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AdminArticle::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * undocumented constant
         **/
        $article = AdminArticle::find($id);
        // dd($article);
        return view('admin_view.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        AdminArticle::where('id', $id)->update(['Title' => $request->Title, 'Body' => $request->Body]);
        // $admArticle->update(['Title' => $request->Title,'Body' => $request->body]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request, $id)
    {
        // dd($request);
        DB::delete('delete from admin_articles where id = ?',[$id]);
        return redirect()->back();
    }

    public function fetchArticles()
    {
        // $articles = DB::table('admin_articles')->pluck('Title');
        $articles = AdminArticle::all();
        // dd($articles);
        // dd($adminArticle);
        return view('admin_view.articles_list', compact('articles'));
    }

    
}
