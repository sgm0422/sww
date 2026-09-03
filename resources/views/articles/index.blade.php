@extends('layouts.site')

@section('title', '法律文章_青岛刑事律师孙伟伟_取保候审与刑事辩护实务')
@section('description', '青岛刑事律师孙伟伟撰写的刑事辩护、取保候审、会见、阅卷等实务普法文章与办案随笔，仅供学习参考。')

@section('content')
    <section class="page-head">
        <div class="container">
            <h1>法律文章</h1>
            <p>青岛刑事律师孙伟伟的刑事法律实务与办案随笔，围绕取保候审、刑事辩护等话题，文章仅供普法参考。</p>
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
