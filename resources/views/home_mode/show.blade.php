<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $trivium->title }}</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/show_item.css',
            ])
    </head>
    <body>
        <main>
            @component('components.show_item', ['trivium' => $trivium])

            @endcomponent
        </main>
    </body>
</html>
