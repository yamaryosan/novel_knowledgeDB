<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $trivium->title}}の編集</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/form.css',
            'resources/css/home_mode/button.css',
            'resources/js/home_mode/edit_form.js',
            'resources/js/home_mode/exit_prevention.js'
            ])
    </head>
    <body>
        <main>
            @component('components.edit_form')
                @slot('id', $trivium->id)
                @slot('title', $trivium->title)
                @slot('summary', $trivium->summary)
                @slot('detail', $trivium->detail)
            @endcomponent
        </main>
    </body>
</html>
