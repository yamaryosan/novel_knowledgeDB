<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>タイトル(仮)</title>
        @vite([
            'resources/css/app.css',
            'resources/css/header.css',
            'resources/css/footer.css',
            'resources/css/content.css',
            'resources/css/sidebar.css',
            ])
    </head>
    <body>
        @include('layouts.header')
        <main>
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.sidebar')
        </main>
        @include('layouts.footer')
    </body>
</html>
