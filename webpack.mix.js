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

//
// mix.js('resources/js/plugins/index.js', 'public/js/master.js')
//     .css('resources/css/plugins/index.css', 'public/css/master.css');

var path = {
    'js': "./resources/js/",
    'css': "./resources/css/",

}

mix.styles([
    path.css + 'plugins/adminlte.min.css',
    path.css + 'plugins/all.min.css',
    path.css + 'plugins/daterangepicker.css',
    path.css + 'plugins/icheck-bootstrap.min.css',
    path.css + 'plugins/jqvmap.min.css',
    path.css + 'plugins/OverlayScrollbars.min.css',
    path.css + 'plugins/summernote-bs4.min.css',
    path.css + 'plugins/tempusdominus-bootstrap-4.css',
    // path.css + 'custom',
], 'public/css/master.css').version();


mix.scripts([
    path.js + 'plugins/adminlte.js',
    path.js + 'plugins/jquery.js',
    path.js + 'plugins/Chart.min.js',
    path.js + 'plugins/jquery.min.js',
    path.js + 'plugins/bootstrap.bundle.js',
    path.js + 'plugins/jquery-ui.min.js',
    path.js + 'plugins/jquery.knob.min',
    path.js + 'plugins/jquery.overlayScrollbars.min.js',
    path.js + 'plugins/jquery.vmap.min.js',
    path.js + 'plugins/jquery.vmap.usa.js',
    path.js + 'plugins/moment.min.js',
    path.js + 'plugins/sparkline.js',
    path.js + 'plugins/summernote-bs4.min.js',
    path.js + 'plugins/daterangepicker.js',
    path.js + 'plugins/demo.js',
    path.js + 'plugins/dashboard.js',
    path.js + 'plugins/tempusdominus-bootstrap-4.min.js',
    // path.jss + 'custom',
], 'public/js/master.js').version();


