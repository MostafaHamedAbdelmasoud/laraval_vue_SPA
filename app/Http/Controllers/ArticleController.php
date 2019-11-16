<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
// the as for aliasing or some shit
use App\Http\Requests;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get articles
        $articles = Article::orderBy('created_at', 'desc')->Paginate(5);;
        //return collection of articles as a resource

        // return  ($articles);
        return ArticleResource::collection($articles);
        //if you return a list of items use a collection, from resources

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;        //to ake a new row or to edit an existing one
        $article->id = $request->input('article_id');
        //article_id the data in it coes from the user
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return ($article);
            //article is returned as a json data
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
        //get articale
        $article = Article::findOrFail($id);
        //return single article 
        return ($article);
        //will return as a json data
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->delete()) {
            return ($article);
            //will return the deleted article to be shown
        }
    }
}
