<div class="article_item_container">
    <a href="{{ route('soft_delete_preview', ['id' => $trivium->id]) }}" class="trivium_link">
        <div class="trivium_unit">
            <div class="item_title">
                @if ($trivium->title === '')
                    <h3>タイトルなし</h3>
                @else
                    <h3>{{ $trivium->title }}</h3>
                @endif
            </div>
            <div class="item_summary">
                @if ($trivium->summary === '')
                    <p>{{ Str::limit($trivium->detail, 100) }}</p>
                @else
                    <p>{{ Str::limit($trivium->summary, 300) }}</p>
                @endif
            </div>
            <div class="item_footer">
                <p>{{ $trivium->updated_at }}</p>
            </div>
        </div>
    </a>
    @component('components.delete_button')
        @slot('route', 'delete')
        @slot('id', $trivium->id)
    @endcomponent
</div>
