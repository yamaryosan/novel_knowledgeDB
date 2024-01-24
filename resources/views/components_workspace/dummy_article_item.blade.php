<div class="article_item_container">
    <a class="trivium_link" href="{{ route('workspace_dummy_show', ['id' => $dummy_article->id]) }}">
        <div class="trivium_unit">
            <h3>{{ $dummy_article->title }}</h3>
            @if ($dummy_article->summary === '')
                <p>{{ Str::limit($dummy_article->detail, 500) }}</p>
            @else
                <p>{{ Str::limit($dummy_article->summary, 500) }}</p>
            @endif
            <p>{{ $dummy_article->updated_at }}</p>
        </div>
    </a>
</div>
