<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
        <title>タイトル(仮)</title>
        @vite([
            'resources/css/app.css',
            'resources/css/header.css',
            'resources/css/footer.css',
            'resources/css/content.css',
            'resources/css/sidebar.css',
            'resources/css/workspace_mode/article_item.css',
            'resources/css/workspace_mode/show_item.css',
            'resources/css/home_mode/pagination.css',
            ])
    </head>
    <body>
        @include('layouts.header')
        <main>
            <div class="content">
                @yield('content')
            </div>
            @section('sidebar')
            @show
        </main>
        @include('layouts.footer')
    </body>
</html>
