@extends('layouts.site')

@section('title', '联系预约')
@section('description', '联系律师进行刑事法律咨询与案件委托预约。')

@section('content')
    <section class="page-head">
        <div class="container">
            <h1>联系与预约</h1>
            <p>咨询前请先预约，涉及具体案情请到所面谈。</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card-grid contact-grid">
                <div class="feature-card">
                    <h3>电话</h3>
                    <p><a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a></p>
                    <p class="muted">工作日 9:00–18:00，如未能接听请短信留言。</p>
                </div>
                <div class="feature-card">
                    <h3>邮箱</h3>
                    <p><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></p>
                    <p class="muted">请勿在邮件中发送未经脱敏的当事人隐私材料。</p>
                </div>
                <div class="feature-card">
                    <h3>办公地址</h3>
                    <p>{{ config('site.address') }}</p>
                    <p class="muted">来访请提前预约，凭预约信息进入。</p>
                </div>
            </div>

            <div class="note-box">
                <h3>预约提示</h3>
                <p>本站不提供在线法律咨询承诺。家属咨询时建议准备：当事人姓名、羁押场所、涉嫌罪名、办案单位及案件所处阶段；涉及未成年人、经济困难等特殊情况请一并告知。</p>
            </div>
        </div>
    </section>
@endsection
