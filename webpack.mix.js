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

mix.sass('resources/sass/app.scss', 'public/dist/css').sass('node_modules/bulma/bulma.sass', 'public/dist/css').styles(["node_modules/normalize.css/normalize.css"], 'public/dist/css/normalize.css');
