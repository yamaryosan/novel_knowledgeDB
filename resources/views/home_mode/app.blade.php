<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>タイトル(仮)</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/search_window.css',
            'resources/css/home_mode/import.css',
            'resources/css/home_mode/export.css',
            'resources/css/home_mode/link_btn.css',
            'resources/css/home_mode/error_message.css',
            'resources/css/home_mode/import_succeed.css',
            'resources/css/home_mode/article_item.css',
            'resources/js/home_mode/import.js',
            'resources/js/home_mode/error_message_hide.js',
            'resources/js/home_mode/import_error_detect.js',
            'resources/js/home_mode/import_succeed_message_hide.js',
            'resources/js/home_mode/keyword_empty_error.js',
            ])
    </head>
    <body>
        <main>
            @yield('content')
        </main>
    </body>
</html>
