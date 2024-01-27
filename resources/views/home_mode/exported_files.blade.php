<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>エクスポートファイル</title>
        @vite([
            'resources/css/app.css',
            'resources/css/home_mode/home_mode.css',
            'resources/css/home_mode/button.css',
            'resources/css/home_mode/table.css',
            'resources/css/home_mode/progress.css',
            'resources/css/home_mode/import_succeed.css',
            'resources/css/home_mode/error_message.css',
            'resources/css/home_mode/previous_page_link.css',
            'resources/js/home_mode/import_succeed_message_hide.js',
            'resources/js/home_mode/error_message_hide.js',
            'resources/js/home_mode/export.js',
            'resources/js/home_mode/export_file_delete_alert.js',
            ])
    </head>
    <body>
        <main>
            @component('components.files_table')
                @slot('files', $files)
            @endcomponent
            @component('components.button')
            @slot('name', 'export')
            @slot('image' , 'download')
            @slot('color', 'blue')
            @slot('data_name', 'export')
            @slot('data_value', 'export')
            @endcomponent
            <progress id="progressBar" max="100" value="0"></progress>
            @component('components.previous_page_link')
            @slot('previousPageUrl', route('home'))
            @endcomponent

            @component('components.error_message')

            @endcomponent

            @component('components.import_succeed')

            @endcomponent
        </main>
    </body>
</html>
