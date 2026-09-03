@extends('layouts.site')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')
    <article class="post">
        <header class="post-head">
            <div class="container">
                <div class="article-meta">
                    @if ($article->category)
                        <span class="badge">{{ $article->category->name }}</span>
                    @endif
                    <time>{{ $article->published_at->format('Y年m月d日') }}</time>
                    <span>{{ config('site.lawyer_name') }}</span>
                </div>
                <h1>{{ $article->title }}</h1>
                @if ($article->excerpt)
                    <p class="post-excerpt">{{ $article->excerpt }}</p>
                @endif
            </div>
        </header>

        <div class="container">
            @if ($article->cover_image)
                <img class="post-cover" src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}">
            @endif

            <div class="post-content">
                {!! $article->body !!}
            </div>

            <div class="post-footer">
                <p>本文由{{ config('site.lawyer_name') }}撰写/整理，仅供普法参考，不构成对任何个案的法律意见。</p>
                <a class="btn btn-primary" href="{{ route('contact') }}">如需个案咨询，请预约面谈</a>
            </div>
        </div>
    </article>
@endsection
