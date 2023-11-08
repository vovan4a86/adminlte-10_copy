import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/admin/css/admin-app.css',
                'resources/admin/js/admin-app.js',
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
            '~adminlte': path.resolve(__dirname, 'node_modules/admin-lte'),
            '~overlayscrollbars': path.resolve(__dirname, 'node_modules/overlayscrollbars'),
            '~icheck-bootstrap': path.resolve(__dirname, 'node_modules/icheck-bootstrap'),
        }
    },
});
