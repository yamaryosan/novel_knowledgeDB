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
            ])
    </head>
    <body>
        <main>
            @yield('content')
        </main>
    </body>
</html>
