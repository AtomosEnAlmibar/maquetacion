const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/js/desktop/admin/app.js', 'public/desktop/admin/js')
    .js('resources/js/desktop/front/app.js', 'public/desktop/front/js')
    .js('resources/js/mobile/admin/app.js', 'public/mobile/admin/js')
    .js('resources/js/mobile/front/app.js', 'public/mobile/front/js')
    .sass('resources/sass/desktop/admin/app.scss', 'public/desktop/admin/css')
    .sass('resources/sass/desktop/front/app.scss', 'public/desktop/front/css')
    .sass('resources/sass/mobile/admin/app.scss', 'public/mobile/admin/css')
    .sass('resources/sass/mobile/front/app.scss', 'public/mobile/front/css');