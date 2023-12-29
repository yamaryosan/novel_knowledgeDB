<div class="random">
    <h2>ランダム表示</h2>
    <div class="random_container">
        @foreach ($randomTrivia as $trivium)
            @component('components.article_item')
                @slot('trivium', $trivium)
            @endcomponent
        @endforeach
    </div>
</div>
