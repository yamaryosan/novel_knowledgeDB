<!-- 雑学項目プレビューフォーム -->

@if ( $mode === 'create')
    <!-- 新規作成時 -->
    <form class="submit_form" method="POST" data-back-route="{{ route('back') }}" data-store-route="{{ route('store') }}">
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
        <input type="hidden" name="mode" value="create">
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
@elseif ($mode === 'edit')
    <!-- 編集時 -->
    <form class="submit_form" method="POST" data-back-route="{{ route('back') }}" data-update-route="{{ route('update', ['id'=>$id]) }}">
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
        <input type="hidden" name="mode" value="edit">
        <input type="hidden" name="id" value="{{ $id }}">
        @component('components.button')
        @slot('name', 'back')
        @slot('image', 'return')
        @slot('color', 'red')
        @slot('onclick', '')
        @endcomponent
        @component('components.button')
        @slot('name', 'submit')
        @slot('image', 'update')
        @slot('color', 'blue')
        @endcomponent
    </form>
@endif

<!-- スマホ用エラーメッセージ -->
@component('components.pc_only_message')

@endcomponent
