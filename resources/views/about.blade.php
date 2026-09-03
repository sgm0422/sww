@extends('layouts.site')

@section('title', '青岛刑事律师孙伟伟_执业经历与办案理念')
@section('description', '孙伟伟律师系山东雅君律师事务所合伙人、副主任律师，专注青岛及山东地区刑事辩护业务，介绍其刑事辩护、取保候审、不起诉、缓刑、无罪辩护等执业经历与办案理念。')

@section('content')
    <section class="page-head">
        <div class="container">
            <h1>关于{{ config('site.lawyer_name') }}</h1>
            <p>{{ config('site.organization') }}合伙人、副主任律师，专注青岛地区刑事辩护与刑事法律风险防控。</p>
        </div>
    </section>

    <section class="section">
        <div class="container content-narrow">
            <h2>执业简介</h2>
            @foreach (config('site.lawyer_intro') as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach

            <h2>办案理念</h2>
            <p>刑事辩护的价值不在于迎合任何一方，而在于依法提出有理有据的意见。律师应当重视会见、阅卷、调查取证与庭审发问，从程序与实体两个方面维护当事人的合法权利。</p>
            <blockquote>每个案件都应当被认真对待：证据是否确实充分、程序是否合法、法律适用是否正确、量刑是否适当。</blockquote>

            <h2>保密与合规提示</h2>
            <p>未经当事人同意，律师不应公开可识别当事人身份的案件细节。网站案例文章如涉及真实案件，应当作脱敏处理。</p>
        </div>
    </section>
@endsection
