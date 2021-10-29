const mix = require('laravel-mix');
const {sass} = require("laravel-mix");

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

mix
    .scripts(
        [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
            'node_modules/jquery.easing/jquery.easing.js',
            'resources/js/vendor/sb-admin-2.js',
            'resources/js/vendor/Chart.js',
            'resources/js/vendor/chart-area-demo.js',
            'resources/js/vendor/chart-pie-demo.js',
        ],
        'public/js/vendor.min.js'
    )
    .styles(
        ['node_modules/@fortawesome/fontawesome-free/css/all.css'],
        'public/css/vendor.min.css'
    )
    .sass('resources/sass/sb-admin-2.scss','public/css/bootstrap.min.css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .options({
        processCssUrls: false
    })
    .version();
