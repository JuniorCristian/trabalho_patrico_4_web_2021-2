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
    .scripts('resources/js/vendor/Chart.js','public/js/Chart.min.js')
    .scripts('resources/js/vendor/chart-area-demo.js','public/js/chart-area-demo.min.js')
    .scripts('resources/js/vendor/chart-pie-demo.js','public/js/chart-pie-demo.min.js')
    .scripts(
        [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
            'node_modules/jquery.easing/jquery.easing.js',
            'resources/js/vendor/sb-admin-2.js',
            'node_modules/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.js',
            'node_modules/datatables.net/js/jquery.dataTables.js',
            'node_modules/datatables.net-autofill/js/dataTables.autoFill.js',
            'node_modules/datatables.net-autofill-bs4/js/autoFill.bootstrap4.js',
            'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
            'node_modules/datatables.net-buttons/js/dataTables.buttons.js',
            'node_modules/datatables.net-buttons/js/buttons.colVis.js',
            'node_modules/datatables.net-buttons/js/buttons.flash.js',
            'node_modules/datatables.net-buttons/js/buttons.html5.js',
            'node_modules/datatables.net-buttons/js/buttons.print.js',
            'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.js',
            'node_modules/datatables.net-responsive/js/dataTables.responsive.js',
            'node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.js',
            'node_modules/datatables.net-rowgroup/js/dataTables.rowGroup.js',
            'node_modules/datatables.net-rowgroup-bs4/js/rowGroup.bootstrap4.js'
        ],
        'public/js/vendor.min.js'
    )
    .styles(
        [
            'node_modules/bootstrap-duallistbox/dist/bootstrap-duallistbox.css',
            'node_modules/@fortawesome/fontawesome-free/css/all.css',
            'node_modules/datatables.net-autofill-bs4/css/autoFill.bootstrap4.css',
            'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
            'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css',
            'node_modules/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.css',
            'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css',
            'node_modules/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.css'
        ],
        'public/css/vendor.min.css'
    )
    .sass('resources/sass/sb-admin-2.scss','public/css/bootstrap.min.css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
    .version();
