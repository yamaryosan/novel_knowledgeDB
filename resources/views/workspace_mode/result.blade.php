@extends('layouts.app')

@section('title')
<title>検索結果</title>
@endsection

@section('sidebar')
@parent

@component('components_workspace.sidebar')
@endcomponent
@endsection

@section('content')

@foreach($trivia as $trivium)
    @component('components_workspace.article_item', ['trivium' => $trivium])
    @endcomponent

    @php
        if (count($dummy_articles) == 0) {
            continue;
        }
        $randomDummyArticle = $dummy_articles->random();
    @endphp

    @component('components_workspace.dummy_article_item', ['dummy_article' => $randomDummyArticle])
    @endcomponent
@endforeach

{{ $trivia->links('vendor.pagination.bootstrap-4') }}

@endsection
