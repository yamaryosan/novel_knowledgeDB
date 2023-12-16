<!-- 検索ウィンドウのコンポーネント -->

<div class="search_window">
    <form action="{{ route('search') }}" method="GET">
        <select class="target" name="target">
            <option value="title">Title</option>
            <option value="detail">Detail</option>
            <option value="both">Both</option>
        </select>
        <input class="input" type="text" name="keyword" placeholder="キーワードを入力">
        <input class="submit_btn" type="submit" value="検索">
    </form>
</div>
