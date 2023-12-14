<!-- 検索ウィンドウのコンポーネント -->

<div class="search_window">
    <div class="search_window_inner">
        <div class="search_window_inner_title">
            <h2>検索</h2>
        </div>
        <div class="search_window_inner_form">
            <form action="{{ route('search') }}" method="GET">
                <div class="search_window_inner_form_input">
                    <input type="text" name="keyword" placeholder="キーワードを入力">
                </div>
                <div class="search_window_inner_form_submit">
                    <input type="submit" value="検索">
                </div>
            </form>
        </div>
    </div>
</div>
