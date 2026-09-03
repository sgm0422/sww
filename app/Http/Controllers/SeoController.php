<?php

namespace App\Http\Controllers;

use App\Models\Article;

class SeoController extends Controller
{
    public function robots()
    {
        return response()
            ->view('seo.robots')
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap()
    {
        $articles = Article::query()
            ->published()
            ->orderByDesc('published_at')
            ->get();

        return response()
            ->view('seo.sitemap', compact('articles'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
