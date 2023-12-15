<!-- 検索ウィンドウのコンポーネント -->

<div class="search_window">
    <form action="{{ route('search') }}" method="GET">
        <div class="search_window_inner_form_input">
            <input type="text" name="keyword" placeholder="キーワードを入力">
        </div>
        <div class="search_window_inner_from_select">
            <select name="target">
                <option value="0">Title</option>
                <option value="1">Detail</option>
                <option value="2">Both</option>
            </select>
        </div>
        <div class="search_window_inner_form_submit">
            <input type="submit" value="検索">
        </div>
    </form>
</div>
