const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');

    mix.copy('./node_modules/summernote/dist/font/', 'public/css/font/');
    mix.copy('./node_modules/summernote/dist/summernote.css', 'public/css/summernote.css');
    mix.copy('./node_modules/summernote/dist/summernote.js', 'public/js/summernote.js');
    mix.copy('./node_modules/summernote/dist/lang/summernote-zh-CN.js', 'public/js/summernote-zh-CN.js');

    mix.styles([
        './public/css/core.css',
        './public/css/components.css',
        './public/css/icons.css',
        './public/css/pages.css',
        './public/css/menu.css',
        './public/css/responsive.css'
    ], 'public/css/all.css');
    mix.scripts([
        './public/js/detect.js',
        './public/js/fastclick.js',
        './public/js/jquery.blockUI.js',
        './public/js/waves.js',
        './public/js/jquery.slimscroll.js',
        './public/js/jquery.scrollTo.min.js'
    ], 'public/js/all.js')
});
