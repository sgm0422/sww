@extends('layouts.site')

@section('title', $article->title . '_青岛刑事律师孙伟伟')
@section('description', $article->excerpt)
@section('og_type', 'article')
@section('schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": @json(request()->url(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)
        },
        "headline": @json($article->title, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        "description": @json($article->excerpt, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        "image": @json($article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/sww-1200.jpg'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES),
        "datePublished": @json($article->published_at->toAtomString(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES),
        "dateModified": @json(optional($article->updated_at)->toAtomString() ?? $article->published_at->toAtomString(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES),
        "author": {
            "@type": "Person",
            "name": @json(config('site.lawyer_name'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            "jobTitle": "合伙人、副主任律师",
            "worksFor": {
                "@type": "LegalService",
                "name": @json(config('site.organization'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            }
        },
        "publisher": {
            "@type": "LegalService",
            "name": @json(config('site.organization'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        }
    }
    </script>
@endsection

@section('content')
    <article class="post">
        <header class="post-head">
            <div class="container">
                <div class="article-meta">
                    @if ($article->category)
                        <span class="badge">{{ $article->category->name }}</span>
                    @endif
                    <time>{{ $article->published_at->format('Y年m月d日') }}</time>
                    <span>阅读 {{ $article->views_count }}</span>
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
