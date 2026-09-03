@extends('layouts.site')

@section('title', '首页')
@section('description', config('site.slogan'))

@section('content')
    <section class="hero">
        <div class="container">
            <p class="hero-kicker">刑事辩护 · 刑事合规 · 案件代理</p>
            <h1>{{ config('site.slogan') }}</h1>
            <p class="hero-text">以事实为依据，以法律为准绳，在每一个阶段为当事人争取合法权益。本页面文案均为示例，请替换为您的真实执业信息。</p>
            <div class="hero-actions">
                <a class="btn btn-light" href="{{ route('articles.index') }}">阅读文章</a>
                <a class="btn btn-outline" href="{{ route('contact') }}">预约咨询</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">ABOUT</span>
                <h2>关于{{ config('site.lawyer_name') }}</h2>
            </div>
            <div class="about-preview">
                <div>
                    <p>这里是律师个人简介的占位内容：建议写明执业机构、执业年限、主要方向（如经济犯罪、职务犯罪、毒品犯罪、暴力犯罪等）以及办案理念。刑事辩护关乎自由与生命，律师的职责是依法提出无罪、罪轻的意见，监督办案程序，维护当事人的合法权益。</p>
                    <a class="text-link" href="{{ route('about') }}">查看详细介绍 →</a>
                </div>
                <a class="btn btn-primary" href="{{ route('practice') }}">了解刑事业务</a>
            </div>
        </div>
    </section>

    <section class="section section-light">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">PRACTICE</span>
                <h2>主要业务领域</h2>
            </div>
            <div class="card-grid">
                <div class="feature-card">
                    <h3>取保候审 / 羁押必要性审查</h3>
                    <p>为符合法定条件的犯罪嫌疑人、被告人依法申请取保候审、变更强制措施。</p>
                </div>
                <div class="feature-card">
                    <h3>侦查阶段辩护</h3>
                    <p>及时会见、了解案情，申请变更强制措施，依法提出法律意见。</p>
                </div>
                <div class="feature-card">
                    <h3>审查起诉阶段</h3>
                    <p>查阅案卷、核实证据，提出不起诉或改变定性的法律意见。</p>
                </div>
                <div class="feature-card">
                    <h3>审判阶段辩护</h3>
                    <p>围绕事实、证据与法律充分发表辩护意见，维护当事人的合法权利。</p>
                </div>
                <div class="feature-card">
                    <h3>申诉 / 再审代理</h3>
                    <p>对生效裁判依法提出申诉，代理再审与国家赔偿相关程序。</p>
                </div>
                <div class="feature-card">
                    <h3>刑事合规与咨询</h3>
                    <p>面向企业与个人提供刑事法律风险识别、合规建议与专项咨询。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">NEWS</span>
                <h2>最新文章</h2>
                <a class="text-link" href="{{ route('articles.index') }}">全部文章 →</a>
            </div>
            <div class="article-grid">
                @forelse ($articles as $article)
                    <a class="article-card" href="{{ route('articles.show', $article->slug) }}">
                        <div class="article-card-body">
                            <div class="article-meta">
                                @if ($article->category)
                                    <span class="badge">{{ $article->category->name }}</span>
                                @endif
                                <time>{{ $article->published_at->format('Y年m月d日') }}</time>
                            </div>
                            <h3>{{ $article->title }}</h3>
                            <p>{{ $article->excerpt }}</p>
                        </div>
                    </a>
                @empty
                    <p class="empty-tip">还没有已发布的文章，去后台发布第一篇吧。</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="cta-band">
        <div class="container">
            <h2>需要咨询刑事案件？</h2>
            <p>请先电话或邮件预约，简要说明情况；请勿在公共渠道发送涉及他人隐私的材料。</p>
            <a class="btn btn-light" href="{{ route('contact') }}">联系预约</a>
        </div>
    </section>
@endsection
