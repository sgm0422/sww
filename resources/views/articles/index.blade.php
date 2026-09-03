@extends('layouts.site')

@section('title', '法律文章')
@section('description', '刑事法律知识、办案随笔与实务文章。')

@section('content')
    <section class="page-head">
        <div class="container">
            <h1>法律文章</h1>
            <p>刑事法律实务与办案随笔，文章仅供普法参考。</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="article-list">
                @forelse ($articles as $article)
                    <a class="article-card article-card-row" href="{{ route('articles.show', $article->slug) }}">
                        <div class="article-card-body">
                            <div class="article-meta">
                                @if ($article->category)
                                    <span class="badge">{{ $article->category->name }}</span>
                                @endif
                                <time>{{ $article->published_at->format('Y年m月d日') }}</time>
                                <span>阅读 {{ $article->views_count }}</span>
                            </div>
                            <h2>{{ $article->title }}</h2>
                            <p>{{ $article->excerpt }}</p>
                        </div>
                    </a>
                @empty
                    <p class="empty-tip">暂无文章。</p>
                @endforelse
            </div>

            {{ $articles->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endsection
