import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
    resolve: {
        alias: {
            '~adminlte': path.resolve(__dirname, 'node_modules/admin-lte'),
            '~overlayscrollbars': path.resolve(__dirname, 'node_modules/overlayscrollbars'),
            '~icheck-bootstrap': path.resolve(__dirname, 'node_modules/icheck-bootstrap'),
        }
    }
});
