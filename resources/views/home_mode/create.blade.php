<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>新規追加</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/new_addition.css',
            'resources/js/home_mode/new_addition.js',
            'resources/js/home_mode/exit_prevention.js'
            ])
    </head>
    <body>
        <main>
            @component('components.new_addition')

            @endcomponent
        </main>
    </body>
</html>
