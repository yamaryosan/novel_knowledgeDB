@extends('layouts.app')

@section('sidebar')
@parent

@component('components_pseudo.sidebar')
@endcomponent
@endsection

@section('content')

<h2>自己紹介</h2>
<p>はじめまして！saruと申します。</p>
<p>営業職からITエンジニアを目指して勉強中です。</p>
<p>HTML, CSS, JS, PHP, Laravel, React等の知識を自分用にまとめていくサイトです。</p>
<p>少しでも参考になれば幸いです。</p>

<h3>まずは下の記事から</h3>
@component('components_pseudo.recommend_articles')
@endcomponent

@endsection
