<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $trivium->title}}の編集</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/edit_form.css'
            ])
    </head>
    <body>
        <main>
            @component('components.edit_form',
            ['id'=>$trivium->id, 'title'=>$trivium->title, 'summary'=>$trivium->summary, 'detail'=>$trivium->detail])

            @endcomponent
        </main>
    </body>
</html>
