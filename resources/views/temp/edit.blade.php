<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>一時保存項目編集</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/edit_form.css',
            'resources/js/temp/temp_edit_form.js',
            'resources/js/home_mode/exit_prevention.js',
            'resources/js/temp/temp_edit_form.js'
            ])
    </head>
    <body>
        <main>
            @component('components.temp_edit_form')
                @slot('id', $tempTrivium->id)
                @slot('title', $tempTrivium->title)
                @slot('summary', $tempTrivium->summary)
                @slot('detail', $tempTrivium->detail)
            @endcomponent
        </main>
    </body>
</html>
