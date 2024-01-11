<!-- 一時保存項目編集フォーム -->

<form class="submit_form" method="POST" data-save-route="{{ route('temp_update', ['id'=>$id]) }}" data-submit-route="{{ route('temp_preview', ['id'=>$id]) }}">
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
    @component('components.button')
    @slot('name', 'save_btn')
    @slot('image', 'paper_and_pen')
    @slot('color', 'green')
    @endcomponent
    @component('components.button')
    @slot('name', 'submit_btn')
    @slot('image', 'plus')
    @slot('color', 'blue')
    @endcomponent
</form>

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
