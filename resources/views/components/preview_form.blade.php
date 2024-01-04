<!-- 雑学項目プレビューフォーム -->

@if ( $mode === 'create')
    <!-- 新規作成時 -->
    <form action="{{ route('store') }}" class="submit_form" method="POST">
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
        <input type="button" onclick="history.back()" value="戻る" class="back_btn">
        <input type="submit" value="投稿" class="submit_btn">
    </form>
@elseif ($mode === 'edit')
    <!-- 編集時 -->
    <form action="{{ route('update', ['id'=>$id]) }}" class="submit_form" method="POST">
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
        <input type="button" onclick="history.back()" value="戻る" class="back_btn">
        <input type="submit" value="更新" class="submit_btn">
    </form>
@endif

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
