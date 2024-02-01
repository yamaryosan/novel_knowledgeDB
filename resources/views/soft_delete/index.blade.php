<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
        <title>削除前</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/result.css',
            'resources/css/home_mode/article_item.css',
            'resources/css/home_mode/pagination.css',
            'resources/css/home_mode/previous_page_link.css',
            'resources/css/home_mode/import_succeed.css',
            'resources/css/home_mode/button.css',
            'resources/js/home_mode/article_item.js',
            'resources/js/home_mode/import_succeed_message_hide.js',
            'resources/js/home_mode/delete_button.js'
            ])
    </head>

    <body>
        <main>
            @if(count($softDeleteTrivia) === 0)
            <p>削除候補の項目はありません。</p>
            @component('components.button')
                @slot('name', 'top')
                @slot('image', 'return')
                @slot('color', 'red')
                @slot('link', '/home')
            @endcomponent
        @endif
        @foreach($softDeleteTrivia as $softDeleteTrivium)
            @component('components.soft_delete_item', ['trivium' => $softDeleteTrivium, 'previousPageUrl' => $previousPageUrl])
            @endcomponent
        @endforeach

        @component('components.previous_page_link', ['previousPageUrl' => $previousPageUrl])

        @endcomponent

        @component('components.succeed_message')
        
        @endcomponent
        </main>
</html>
