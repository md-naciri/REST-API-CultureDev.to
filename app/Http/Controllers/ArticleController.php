<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Filters\ArticlesFilter;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $articles = Article::all();
        // return new ArticleCollection($articles);

        $filter = new ArticlesFilter();
        $queryItem = $filter->transform($request);
        if(count($queryItem) == 0){
            $articles = Article::all();
            return new ArticleCollection($articles);
        } else {
                $articles = Article::where($queryItem)->get();
                return new ArticleCollection($articles);



        }
    }

    public function filterCategory( $filter){

      $article=Article::join("categories","categories.id","=","articles.category_id")
                        ->where("name","=",$filter)->get();
      return new ArticleCollection($article);

    }


    public function filterTag($filter){

        $tag=Tag::with("articles")->where("name","=",$filter)->first();
        return new ArticleCollection($tag->articles);
  
      }










    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        // return Auth()->user()->id;
        $article = Article::create($request->all() + ['user_id' => Auth()->user()->id])->tags()->attach($request->tags);
        return response()->json([
            'status' => true,
            'message' => "Article Created successfully!",
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticleRequest $request, Article $article)
    {
        $user = Auth::user();
        if(!$user->can('edit All article')  && $user->id != $article->user_id){
            return response()->json([
                'status' => false,
                'message' => "You don't have permission to edit this article!",
            ], 200);
        }
        $article->update($request->all());

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "Article Updated successfully!",
            'article' => $article
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $user = Auth::user();
        if(!$user->can('edit All article')  && $user->id != $article->user_id){
            return response()->json([
                'status' => false,
                'message' => "You don't have permission to delete this article!",
            ], 200);
        }
        $article->delete();

        if (!$article) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Article deleted successfully'
        ], 200);
    }


}
