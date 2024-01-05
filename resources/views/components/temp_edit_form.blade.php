<!-- 雑学項目編集フォーム -->

<form class="submit_form" method="POST" data-temp-save-route="{{ route('temp_update', ['id'=>$id]) }}">
    @csrf
    <div class="title_container">
        <p>タイトル</p>
        <input type="text" class="title_input" name="title" value="{{$title}}" required>
    </div>
    <div class="summary_container">
        <p>概要</p>
        @if($summary === "EMPTY")
            <textarea name="summary" class="summary_input" cols="20" rows="5" required></textarea>
        @else
            <textarea name="summary" class="summary_input" cols="20" rows="5" required>{{ $summary }}</textarea>
        @endif
    </div>
    <div class="detail_container">
        <p>詳細</p>
        <textarea name="detail" class="detail_input" cols="20" rows="5" required>{{ $detail }}</textarea>
    </div>
    <input type="button" class="save_btn" value="再保存">
    <input type="button" class="submit_btn" value="作成">
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
