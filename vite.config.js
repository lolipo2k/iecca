import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/osanscondensed.css', 'resources/css/style.css', 'resources/js/script.js'],
            refresh: true,
        }),
    ],
});
