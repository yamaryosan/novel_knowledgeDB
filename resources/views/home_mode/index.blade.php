@extends('home_mode.app')

@section('content')

@component('components.search_window')

@endcomponent

<a href="{{ route('create') }}">新規追加</a>

<h2>ランダム表示</h2>

<h2>統計情報</h2>

@component('components.import')

@endcomponent

@component('components.export')

@endcomponent

@endsection
