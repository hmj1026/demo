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
    .sass('resources/sass/app.scss', 'public/css')
    .copy('vendor/ckeditor/ckeditor/ckeditor.js', 'public/vendor/ckeditor/ckeditor/ckeditor.js')
    .copy('vendor/ckeditor/ckeditor/config.js', 'public/vendor/ckeditor/ckeditor/config.js')
    .copy('vendor/ckeditor/ckeditor/styles.js', 'public/vendor/ckeditor/ckeditor/styles.js')
    .copy('vendor/ckeditor/ckeditor/contents.css', 'public/vendor/ckeditor/ckeditor/contents.css')
    .copyDirectory('vendor/ckeditor/ckeditor/skins', 'public/vendor/ckeditor/ckeditor/skins')
    .copyDirectory('vendor/ckeditor/ckeditor/lang', 'public/vendor/ckeditor/ckeditor/lang')
    .copyDirectory('vendor/ckeditor/ckeditor/plugins', 'public/vendor/ckeditor/ckeditor/plugins')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/css/bootstrap.min.css.map')
    .copy('node_modules/bootstrap/dist/css/bootstrap-theme.min.css', 'public/css/bootstrap-theme.min.css')
    .copy('node_modules/bootstrap/dist/css/bootstrap-theme.min.css.map', 'public/css/bootstrap-theme.min.css.map')
    .copy('resources/css/menu-styles.css', 'public/css/menu-styles.css')
    .copy('resources/css/quelea-onlineshop.css', 'public/css/quelea-onlineshop.css');
