<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>"{{$keyword}}"の結果</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/result.css',
            'resources/css/home_mode/article_item.css',
            ])
    </head>

    <body>
        <main>
            <div class="head_container">
                <p>キーワード：{{ $keyword }} (対象: {{ $target }})</p>
                <p> {{ $trivia->count() }}件ヒット </p>
            </div>
            @foreach($trivia as $trivium)
                @component('components.article_item', ['trivium' => $trivium])
                @endcomponent
            @endforeach
        </main>
</html>
