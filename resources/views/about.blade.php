@extends('layouts.site')

@section('title', '关于我')
@section('description', '关于律师的执业经历与办案理念。')

@section('content')
    <section class="page-head">
        <div class="container">
            <h1>关于{{ config('site.lawyer_name') }}</h1>
            <p>以上介绍均为占位内容，请替换为真实执业信息后再上线。</p>
        </div>
    </section>

    <section class="section">
        <div class="container content-narrow">
            <h2>执业简介</h2>
            <p>{{ config('site.lawyer_name') }}，执业于{{ config('site.address') }}所在律师事务所，主要办理刑事辩护与刑事法律风险防控业务。执业方向包括经济犯罪、职务犯罪、毒品犯罪、涉黑涉恶案件、暴力犯罪以及刑事申诉等。</p>
            <p>这里建议补充：执业证号、执业年限、主要承办案件类型、既往经历（如公检法经历、法学教育背景）等客观信息。律师宣传应当客观真实，不建议使用“最专业”“第一”“胜诉率最高”等无法证实或可能误导当事人的表述。</p>

            <h2>办案理念</h2>
            <p>刑事辩护的价值不在于迎合任何一方，而在于依法提出有理有据的意见。律师应当重视会见、阅卷、调查取证与庭审发问，从程序与实体两个方面维护当事人的合法权利。</p>
            <blockquote>每个案件都应当被认真对待：证据是否确实充分、程序是否合法、法律适用是否正确、量刑是否适当。</blockquote>

            <h2>保密与合规提示</h2>
            <p>未经当事人同意，律师不应公开可识别当事人身份的案件细节。网站案例文章如涉及真实案件，应当作脱敏处理。</p>
        </div>
    </section>
@endsection
