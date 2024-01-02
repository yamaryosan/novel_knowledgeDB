<div class="article_item_container">
    <a href="{{ route('show', ['id' => $trivium->id]) }}" class="trivium_link">
        <div class="trivium_unit">
            <div class="item_title">
                <h3>{{ $trivium->title }}</h3>
            </div>
            <div class="item_summary">
                @if ($trivium->summary === 'EMPTY')
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
    @component('components.edit_button')
        @slot('id', $trivium->id)
    @endcomponent
    @component('components.delete_button')
        @slot('id', $trivium->id)
    @endcomponent
</div>
