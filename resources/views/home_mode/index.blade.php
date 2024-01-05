@extends('home_mode.app')

@section('content')

<!-- ここにコンテンツを記述 -->

@component('components.search_window')

@endcomponent

<div class="link_btn_container">
    <a href="{{ route('create') }}" class="link_btn">新規追加</a>
</div>

@component('components.random')

@endcomponent


<h2>統計情報</h2>

@component('components.import')

@endcomponent

@component('components.export')

@endcomponent

@component('components.temp_save_button')

@endcomponent

@component('components.error_message')

@endcomponent

@component('components.import_succeed')

@endcomponent

<!-- ここまで -->

@endsection
