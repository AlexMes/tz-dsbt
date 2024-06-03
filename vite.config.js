import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import $ from 'jquery'
window.jQuery = window.$ = $

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                //'resources/js/DBManager/DBManager.js',
            ],
            refresh: true,
        }),
    ],
});
