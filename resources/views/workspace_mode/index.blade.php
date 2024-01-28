@extends('layouts.app')

@section('title')
<title>インデックス</title>
@endsection

@section('sidebar')
@parent

@component('components_workspace.sidebar')
@endcomponent
@endsection

@section('content')

@component('components_workspace.random')

@endcomponent


@endsection
