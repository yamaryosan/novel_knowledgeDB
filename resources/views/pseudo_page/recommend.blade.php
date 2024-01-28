@extends('layouts.app')

@section('title')
<title>おすすめの記事</title>
@endsection

@section('sidebar')
@parent

@component('components_pseudo.sidebar')
@endcomponent
@endsection

@section('content')

<h2>おすすめ記事</h2>

@component('components_pseudo.recommend_articles')

@endcomponent

@endsection
