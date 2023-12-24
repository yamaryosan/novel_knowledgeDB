<p>キーワード：{{ $keyword }} (対象: {{ $target }})</p>
<p> {{ $trivia->count() }}件ヒット </p>

@foreach($trivia as $trivium)
    @component('components.article_item', ['trivium' => $trivium])
    @endcomponent
@endforeach
