<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        // dd($request->Picture->getClientOriginalName());
        if($request->hasFile('Picture'))
        {
            $this->createIsPictureFunction(true, $request);
            return redirect()->back();
        }
        else{
            $this->createIsPictureFunction(false, $request);
            return redirect()->back();
        }
        
    }

    // This function compares wether request has picture or not
    // hence we get the following create query:
    public function createIsPictureFunction($state, $request)
    {
        if($state == true)
        {
            $fileName = $request->Picture->getClientOriginalName();
            $request->Picture->storeAs('images', $fileName, 'public');
            $hide = $request->has('Article_hide') ? true : false;
            AdminArticle::create(['Title' => $request->Title, 
                                    'Body' => $request->Body, 
                                    'Picture' => $fileName,
                                    'Picture_existance' => true,
                                    'Article_hide' => $hide]);
        }
        else if($state == false)
        {
            $hide = $request->has('Article_hide') ? true : false;
            AdminArticle::create(['Title' => $request->Title, 
                                    'Body' => $request->Body, 
                                    'Article_hide' => $hide]);
        }
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
        if($request->hasFile('Picture'))
        {
            $this->editIsPictureFunction(true, $request, $id);
            return redirect()->back();
        }
        else
        {
            $this->editIsPictureFunction(false, $request, $id);
            return redirect()->back();
        }

        
    }

    // Function that checks for $state, similar to createIsPictureFunction
    public function editIsPictureFunction($state, $request, $id)
    {
        if($state == true)
        {
            if($request->Picture)
            {
                Storage::delete('/public/images/'.AdminArticle::find($id)->Picture);
            }
            $hide = $request->has('Article_hide') ? true : false;
            $fileName = $request->Picture->getClientOriginalName();
            $request->Picture->storeAs('images', $fileName, 'public');
            AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                    'Body' => $request->Body, 
                                                    'Picture' => $fileName,
                                                    'Article_hide' => $hide]);
        }
        elseif ($state == false)
        {
            $hide = $request->has('Article_hide') ? true : false;
            $Picture_existance = $request->has('Picture_existance') ? true : false;
            if($Picture_existance == false)
            {    
                Storage::delete('/public/images/'.AdminArticle::find($id)->Picture);   
                AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                        'Body' => $request->Body,
                                                        'Picture' => null,
                                                        'Article_hide' => $hide,
                                                        'Picture_existance' => false]);
            }
        
            else
            {
                AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                        'Body' => $request->Body,
                                                        'Article_hide' => $hide]);   
            }
        }
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

    protected function deleteOldImage($image)
    {
        
    }
}
