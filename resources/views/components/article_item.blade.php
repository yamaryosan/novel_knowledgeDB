<a href="{{ route('show', ['id' => $trivium->id]) }}">
    <div class="trivium">
        <div class="item_title">
            <h3>{{ $trivium->title }}</h3>
        </div>
        <div class="item_summary">
            @if ($trivium->summary !== 'EMPTY')
                <p>{{ $trivium->summary }}</p>
            @endif
        </div>
        <div class="item_detail">
            <p>{{ $trivium->detail }}</p>
        </div>
        <div class="item_footer">
            <p>作成日：{{ $trivium->created_at }}</p>
            <p>更新日：{{ $trivium->updated_at }}</p>
        </div>
    </div>
</a>
