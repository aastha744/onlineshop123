const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/back/app.js', 'public/js/back.js')
    .js('resources/js/front/app.js', 'public/js/front.js')
    .sass('resources/sass/back/app.scss', 'public/css/back.css')
    .sass('resources/sass/front/app.scss', 'public/css/front.css')
    .options({
        processCssUrls:false,
    })
    .sourceMaps();
