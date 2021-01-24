<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $article =Article::all();
            return $article;
    }




    public function store(Request $request)
    {
        $article=$request->isMethod('put')?Article::findOrFail($request->article_id): new Article;
        $article->id=$request->input('artile_id');
        $article->title=$request->input('title');
        $article->body=$request->input('body');

        if($article->save()){return $article;}

    }


    public function show($id)
    {
        $article=Article::findOrFail($id);
        return $article;
    }


    public function destroy( $id)
    {
        $article=Article::destroy($id);
        return $article;
    }
}
