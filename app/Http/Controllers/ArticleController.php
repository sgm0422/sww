<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->published()
            ->with('category')
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('articles.show', compact('article'));
    }
}
