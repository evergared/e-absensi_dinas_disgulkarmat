import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server :{
        host : true
    },
    plugins: [
        laravel({
            input: [
                'resources/css/sb-admin.css',
                'resoureces/css/absensi-dinas.js',
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    }
});
