let mix = require('laravel-mix');

mix.setPublicPath('public/cities');

mix.sourcemaps = true;
mix.js([
    'resources/assets/js--cities/cities.js',
], 'public/static/js/cities.js')
    .scripts([
        'public/static/js/cities.js',
    ], 'public/static/js/cities.js')
    .version();
