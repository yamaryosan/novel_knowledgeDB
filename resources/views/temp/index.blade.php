<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
        <title>一時保存</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/result.css',
            'resources/css/home_mode/article_item.css',
            'resources/css/home_mode/pagination.css',
            'resources/css/home_mode/previous_page_link.css',
            'resources/css/home_mode/import_succeed.css',
            'resources/js/home_mode/article_item.js',
            'resources/js/home_mode/import_succeed_message_hide.js',
            ])
    </head>

    <body>
        <main>
            @foreach($tempTrivia as $trivium)
                @component('components.temp_item', ['trivium' => $trivium, 'previousPageUrl' => $previousPageUrl])
                @endcomponent
            @endforeach

            @component('components.previous_page_link', ['previousPageUrl' => $previousPageUrl])

            @endcomponent

            @component('components.import_succeed')

            @endcomponent
        </main>
</html>
