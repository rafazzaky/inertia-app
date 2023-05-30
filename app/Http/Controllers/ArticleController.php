<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Topic;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Jobs\SendArticleEmail;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Articles/Index', [
            'articles' => ArticleResource::collection(Article::with('topic')->get())->toArray(Request::instance()),
        ]);
    }

    public function create()
    {
        $topics = Topic::all();

        return Inertia::render('Articles/Create', [
            'topics' => $topics,
        ]);
    }

    public function store(StoreArticleRequest $request)
    {

        $validatedData = $request->validated();

        $article = Article::create($validatedData);

        SendArticleEmail::dispatch($request->user(), $article);

        return Redirect::route('articles.index');
    }
    
    public function edit(Article $article)
    {
        $topics = Topic::all();

        return Inertia::render('Articles/Edit', [
            'article' => $article,
            'topics' => $topics,
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $article->update($validatedData);

        return Redirect::route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return Redirect::route('articles.index');
    }
}
