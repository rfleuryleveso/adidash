const mix = require("laravel-mix");

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

mix.sass("resources/sass/app.scss", "public/dist/css")
    .sass("node_modules/bulma/bulma.sass", "public/dist/css")
    .css("node_modules/bulma-steps/dist/css/bulma-steps.css", "public/dist/css")
    .js("node_modules/bulma-steps/dist/js/bulma-steps.min.js", "public/dist/js/bulma-steps.min.js")
    .styles(
        ["node_modules/normalize.css/normalize.css"],
        "public/dist/css/normalize.css"
    )
    .js('resources/js/app.js', 'public/dist/js/app.js')
    .js('resources/js/calendar/index.js', 'public/dist/js/calendar.js')