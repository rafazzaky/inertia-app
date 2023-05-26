<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('topic')->get();

        return Inertia::render('Articles/Index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        $topics = Topic::all();

        return Inertia::render('Articles/Create', [
            'topics' => $topics,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'topic_id' => 'required|exists:topics,id',
        ]);

        Article::create($validatedData);

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
