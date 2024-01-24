@extends('layouts.app')

@section('sidebar')
@parent

@component('components_workspace.sidebar')
@endcomponent
@endsection

@section('content')

@component('components_workspace.show_item', ['trivium' => $trivium])

@endcomponent

@endsection
