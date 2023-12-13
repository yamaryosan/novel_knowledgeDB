<div class="sidebar">
    <div class="search">
        <form action={{ route('secret') }} method="post">
            @csrf
            <input type="text" name="keyword" placeholder="example" value="">
            <input type="submit" value="検索">
        </form>
    </div>
    <div class="recommend">
        <p>おすすめ記事</p>
    </div>
    <div class="new_article">
        <p>新着記事</p>
    </div>
</div>
