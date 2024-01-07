<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>「{{ $title }}」のプレビュー</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/preview_form.css',
            'resources/js/home_mode/preview_form.js'
            ])
    </head>
    <body>
        <main>
            @component('components.temp_preview_form')
            @slot('id', $id)
            @slot('title', $title)
            @slot('summary', $summary)
            @slot('detail', $detail)
            @endcomponent
        </main>
    </body>
</html>
