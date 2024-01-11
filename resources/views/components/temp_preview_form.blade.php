<!-- 一時保存項目プレビューフォーム -->

<form class="submit_form" method="POST"  data-back-route="{{ route('temp_back') }}" data-submit-route="{{ route('temp_migrate', ['id' => $id]) }}">
    @csrf
    <div class="title_container">
        <p>タイトル</p>
        <input type="text" class="title_input" name="title" value="{{$title}}" readonly>
    </div>
    <div class="summary_container">
        <p>概要</p>
        <textarea name="summary" class="summary_input" cols="20" rows="5" readonly>{{ $summary }}</textarea>
    </div>
    <div class="detail_container">
        <p>詳細</p>
        <textarea name="detail" class="detail_input" cols="20" rows="5" readonly>{{ $detail }}</textarea>
    </div>
    <input type="hidden" name="id" value="{{ $id }}">
    @component('components.button')
    @slot('name', 'back')
    @slot('image', 'return')
    @slot('color', 'red')
    @endcomponent
    @component('components.button')
    @slot('name', 'submit')
    @slot('image', 'plus')
    @slot('color', 'blue')
    @endcomponent
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
