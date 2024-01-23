<div class="article_item_container">
    <a class="trivium_link" href="{{ route('workspace_show', ['id' => $trivium->id]) }}">
        <div class="trivium_unit">
            <h3>{{ $trivium->title }}</h3>
            @if ($trivium->summary === '')
                <p>{{ Str::limit($trivium->detail, 500) }}</p>
            @else
                <p>{{ Str::limit($trivium->summary, 500) }}</p>
            @endif
            <p>{{ $trivium->updated_at }}</p>
        </div>
    </a>
</div>
