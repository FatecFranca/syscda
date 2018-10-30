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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/pages/address.js', 'public/js')
    .js('resources/js/pages/diocese.js', 'public/js')
    .js('resources/js/pages/forania.js', 'public/js')
    .js('resources/js/pages/index.js', 'public/js')
    .js('resources/js/pages/parish.js', 'public/js')
    .js('resources/js/pages/rgi.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/address.scss', 'public/css')
    .sass('resources/sass/pages/diocese.scss', 'public/css')
    .sass('resources/sass/pages/forania.scss', 'public/css')
    .sass('resources/sass/pages/index.scss', 'public/css')
    .sass('resources/sass/pages/login.scss', 'public/css')
    .sass('resources/sass/pages/parish.scss', 'public/css')
    .sass('resources/sass/pages/rgi.scss', 'public/css');

