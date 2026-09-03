<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('site.seo_title'))</title>
    <meta name="description" content="@yield('description', config('site.seo_description'))">
    <meta name="keywords" content="@hasSection('keywords')@yield('keywords')@else{{ implode(',', config('site.keywords')) }}@endif">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ request()->url() }}">
    <meta name="geo.region" content="CN-37">
    <meta name="geo.placename" content="{{ config('site.city_full') }}">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:locale" content="zh_CN">
    <meta property="og:title" content="@yield('title', config('site.seo_title'))">
    <meta property="og:description" content="@yield('description', config('site.seo_description'))">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="{{ asset('images/sww-1200.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1275">
    <meta property="og:image:alt" content="{{ config('site.city') }}刑事律师{{ config('site.lawyer_name') }}个人形象照">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LegalService",
        "@id": "{{ url('/#legal-service') }}",
        "name": "{{ config('site.organization') }}",
        "alternateName": "{{ config('site.name') }}",
        "knowsAbout": [
            "刑事辩护",
            "取保候审",
            "刑事律师",
            "不起诉",
            "缓刑",
            "无罪辩护"
        ],
        "image": "{{ asset('images/sww-1200.jpg') }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ config('site.phone') }}",
        "email": "{{ config('site.email') }}",
        "priceRange": "面议",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ config('site.address') }}",
            "addressLocality": "{{ config('site.city_full') }}",
            "addressRegion": "{{ config('site.province') }}",
            "addressCountry": "CN"
        },
        "areaServed": [
            { "@type": "City", "name": "{{ config('site.city_full') }}" },
            { "@type": "State", "name": "{{ config('site.province') }}" }
        ],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens": "09:00",
            "closes": "18:00"
        },
        "employee": {
            "@type": "Person",
            "name": "{{ config('site.lawyer_name') }}",
            "jobTitle": "合伙人、副主任律师",
            "worksFor": {
                "@type": "LegalService",
                "name": "{{ config('site.organization') }}"
            },
            "telephone": "{{ config('site.phone') }}"
        }
    }
    </script>
    @yield('schema')
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}">{{ config('site.lawyer_name') }}<span>刑辩</span></a>
            <nav class="main-nav">
                @php
                    $current = request()->route()?->getName() ?? '';
                @endphp
                <a href="{{ route('home') }}" class="{{ $current === 'home' ? 'active' : '' }}">首页</a>
                <a href="{{ route('about') }}" class="{{ $current === 'about' ? 'active' : '' }}">关于我</a>
                <a href="{{ route('practice') }}" class="{{ $current === 'practice' ? 'active' : '' }}">刑事业务</a>
                <a href="{{ route('articles.index') }}" class="{{ str_starts_with($current, 'articles') ? 'active' : '' }}">法律文章</a>
                <a href="{{ route('contact') }}" class="{{ $current === 'contact' ? 'active' : '' }}">联系预约</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>{{ config('site.name') }} · 本站内容为普法与经验分享，不构成对具体案件的法律意见或结果承诺。</p>
            <p class="footer-muted">© {{ date('Y') }} {{ config('site.lawyer_name') }} · 电话 {{ config('site.phone') }} · {{ config('site.email') }}</p>
        </div>
    </footer>
</body>
</html>
