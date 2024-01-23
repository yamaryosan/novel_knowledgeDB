@extends('layouts.app')

@section('sidebar')
@parent

@component('components_workspace.sidebar')
@endcomponent
@endsection

@section('content')

@foreach($trivia as $trivium)
    @component('components_workspace.article_item', ['trivium' => $trivium])
    @endcomponent
@endforeach
{{ $trivia->links('vendor.pagination.bootstrap-4') }}

@endsection
