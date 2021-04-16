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

mix.babel([
    'resources/assets/js/app.js',
    'resources/assets/js/other.js',
    'resources/assets/js/ajax.js',
    'resources/assets/js/form.js',
    'resources/assets/js/table.js',
    'resources/assets/js/ui.js',
    'resources/assets/js/validation.js',
    'resources/assets/js/grafik.js'
    ], 'public/js/all.js')
    .styles([
	    'resources/assets/css/candidate-style.css',
        'resources/assets/css/homepage-style.css',
	], 'public/css/candidate-style.min.css')
    .styles([
	    'resources/assets/css/compiler.css',
	    'resources/assets/css/table.css',
	    'resources/assets/css/style.css',
	], 'public/css/all.css');
