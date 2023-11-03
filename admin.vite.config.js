import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin/admin-app.css',
                'resources/js/admin/admin-app.js',
            ],
            refresh: true,
        })
    ],
    css: {
        preprocessorOptions: {
            less: {
                math: "always",
                relativeUrls: true,
                javascriptEnabled: true
            },
        },
    },
    resolve: {
        alias: {
            '~adminlte': path.resolve(__dirname, 'node_modules/admin-lte',),
            // 'jquery': path.resolve(__dirname, 'node_modules/jquery'),
            // 'jquery.fancytree': path.resolve(__dirname, 'node_modules/jquery.fancytree'),
        }
    },
});
