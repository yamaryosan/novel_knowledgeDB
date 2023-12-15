<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>タイトル(仮)</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode.css',
            ])
    </head>
    <body>
        <main>
            @yield('content')
        </main>
    </body>
</html>
