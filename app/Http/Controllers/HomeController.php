<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function __invoke()
    {
        $articles = Article::query()
            ->published()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('articles'));
    }
}
