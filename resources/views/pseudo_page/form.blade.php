@extends('layouts.app')

@section('sidebar')
@parent

@component('components_pseudo.sidebar')
@endcomponent
@endsection

@section('content')

<h2>問い合わせフォーム</h2>

<p>記事に関する疑問や質問は、以下のフォームからお願いします。
    企業案件の依頼も受け付けています。
</p>

<form action="{{ route('form_post') }}" method="post">
    @csrf
    <div class="form_item">
        <label for="name">お名前</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>
    <div class="form_item">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>
    <div class="form_item">
        <label for="content">お問い合わせ内容</label>
        <textarea name="content" id="content" cols="30" rows="10" required>{{ old('content') }}</textarea>
    </div>
    <input type="submit" value="送信">
</form>

@component('components.import_succeed')
@endcomponent

@endsection
