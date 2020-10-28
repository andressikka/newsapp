<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $this->createIsPictureFunction($request->hasFile('Picture'), $request);
        return redirect()->back();
    }


    // This function compares wether request has picture or not
    // hence we get the following create query:
    public function createIsPictureFunction($state, $request)
    {
        if($state == true)
        {
            $fileName = explode( ".",$request->Picture->getClientOriginalName());
            $pictureName = Hash::make($fileName[0]).".".$fileName[1];

            $request->Picture->storeAs('images', $pictureName, 'public');
            $hide = $request->has('Article_hide') ? true : false;
            AdminArticle::create(['Title' => $request->Title, 
                                    'Body' => $request->Body, 
                                    'Picture' => $pictureName,
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
        $this->editIsPictureFunction($request->hasFile('Picture'), $request, $id);
        return redirect()->back();
        
    }

    // Function that checks for $state, similar to createIsPictureFunction
    public function editIsPictureFunction($state, $request, $id)
    {
        $hide = $request->has('Article_hide') ? true : false;

        if(!$request->Picture)
        {
            if($state == false)
            {
                $Picture_existance = $request->has('Picture_existance') ? true : false;
                if($Picture_existance == true)
                {
                    Storage::delete('/public/images/'.$id.AdminArticle::find($id)->Picture);   
                    AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                            'Body' => $request->Body,
                                                            'Picture' => null,
                                                            'Article_hide' => $hide,
                                                            'Picture_existance' => false]);
                    return;
                }
                else
                {
                    AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                                    'Body' => $request->Body,
                                                                    'Article_hide' => $hide,                                                   
                                                                    ]);  
                    return;
                }
            }
        }
        else if($request->Picture)
        {
            Storage::delete('/public/images/'.AdminArticle::find($id)->Picture);

            $fileName = explode( ".",$request->Picture->getClientOriginalName());
            $pictureName = Hash::make($fileName[0]).".".$fileName[1];
            // dd($pictureName);
            $request->Picture->storeAs('images/'.$request->id, $pictureName, 'public');
            AdminArticle::where('id', $id)->update(['Title' => $request->Title, 
                                                    'Body' => $request->Body, 
                                                    'Article_hide' => $hide,
                                                    'Picture' => $pictureName,
                                                    'Picture_existance' => $state]);

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
        Storage::delete('/public/images/'.AdminArticle::find($id)->Picture);
        DB::delete('delete from admin_articles where id = ?',[$id]);
        return redirect()->back();
    }

    public function fetchArticles()
    {
        // $articles = DB::table('admin_articles')->pluck('Title');
        $articles = AdminArticle::all()->sortByDesc('created_at');
        // $articles = AdminArticle::all()->orderby('created_at', 'asc')->get();
        // dd($articles);
        // dd($adminArticle);
        return view('admin_view.articles_list', compact('articles'));
    }

    public function showHiddenArticles()
    {
        $hiddenArticles = AdminArticle::where('Article_hide', 1)->get();
        // dd($hiddenArticles);
        return view('admin_view.hidden_articles', compact('hiddenArticles'));
    }
}
