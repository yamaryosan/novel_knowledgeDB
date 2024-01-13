<!-- 一時保存項目プレビューフォーム -->

<form class="submit_form" method="POST" data-submit-route="{{ route('soft_delete_restore', ['id' => $id]) }}">
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
    @slot('name', 'submit')
    @slot('image', 'upload')
    @slot('color', 'green')
    @endcomponent
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
