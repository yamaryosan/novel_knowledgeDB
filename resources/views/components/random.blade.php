<div class="random">
    <div class="random_container">
        @if (count($randomTrivia) === 0)
            <p>記事がありません。</p>
        @else
            @foreach ($randomTrivia as $trivium)
                @component('components.article_item')
                    @slot('trivium', $trivium)
                @endcomponent
            @endforeach
        @endif
    </div>
</div>
