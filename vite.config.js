import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { glob }  from 'glob';

// CSSとJSファイルのリストを動的に生成
const files = [
    ...glob.sync('resources/css/**/*.css'),
    ...glob.sync('resources/js/**/*.js')
  ];

export default defineConfig({
    plugins: [
        laravel({
            input: files,
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
    },
});
