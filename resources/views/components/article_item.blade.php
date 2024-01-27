<div class="article_item_container">
    <a class="trivium_link" href="{{ route('show', ['id' => $trivium->id]) }}">
        <div class="trivium_unit">
            <h3>{{ $trivium->title }}</h3>
            @if (empty(trim($trivium->summary)))
                <p>{{ Str::limit($trivium->detail, 300) }}</p>
            @else
                <p>{{ Str::limit($trivium->summary, 300) }}</p>
            @endif
            <p>{{ $trivium->updated_at }}</p>
        </div>
    </a>
    @component('components.edit_button')
        @slot('id', $trivium->id)
    @endcomponent
    @component('components.delete_button')
        @slot('id', $trivium->id)
        @slot('route', 'soft_delete')
    @endcomponent
</div>
