<!-- 雑学項目編集フォーム -->

<form class="submit_form" method="POST" data-save-route="{{ route('temp_store', ['id' => $id]) }}" data-submit-route="{{ route('preview', ['id' => $id]) }}">
    @csrf
    <div class="title_container">
        <p>タイトル</p>
        <input type="text" class="title_input" name="title" value="{{$title}}" required>
    </div>
    <div class="summary_container">
        <p>概要</p>
        <textarea name="summary" class="summary_input" cols="20" rows="5" required>{{ $summary }}</textarea>
    </div>
    <div class="detail_container">
        <p>詳細</p>
        <textarea name="detail" class="detail_input" cols="20" rows="5" required>{{ $detail }}</textarea>
    </div>
    <input type="button" value="一時保存" class="save_btn">
    <input type="button" value="追加" class="submit_btn">
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
