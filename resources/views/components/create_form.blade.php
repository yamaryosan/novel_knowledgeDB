<!-- 雑学項目新規追加フォーム -->

<form class="submit_form" method="POST" data-save-route="{{ route('temp_store') }}" data-submit-route="{{ route('preview') }}">
    @csrf
    <div class="title_container">
        <p>タイトル</p>
        <input type="text" class="title_input" name="title" required>
    </div>
    <div class="summary_container">
        <p>概要</p>
        <textarea name="summary" class="summary_input" cols="20" rows="5" required></textarea>
    </div>
    <div class="detail_container">
        <p>詳細</p>
        <textarea name="detail" class="detail_input" cols="20" rows="5" required></textarea>
    </div>
    <input type="button" value="一時保存" class="temp_save_btn">
    <input type="submit" value="追加" class="submit_btn">
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
