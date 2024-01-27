<div class="sidebar">
    <div class="search">
        <form action={{ route('workspace_search') }} method="get">
            <input type="text" name="keyword" value="">
            <input type="submit" value="検索">
        </form>
    </div>
    <div class="recommend">
        <p>おすすめ記事</p>
        @component('components_pseudo.recommend_articles')
        @endcomponent
    </div>
    <div class="new_article">
        <p>新着記事</p>
        @component('components_pseudo.new_articles')
        @endcomponent
    </div>
</div>
