<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title')@yield('title') - {{ config('site.name') }}@else{{ config('site.name') }}@endif</title>
    <meta name="description" content="@yield('description', config('site.slogan'))">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
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
