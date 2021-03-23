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
mix.webpackConfig({
    output: {
        library: ['bulmaCalendar']
    }
});

mix.sass("resources/sass/app.scss", "public/dist/css")
    .sass("node_modules/bulma/bulma.sass", "public/dist/css")
    .css("node_modules/bulma-steps/dist/css/bulma-steps.css", "public/dist/css")
    .styles(["node_modules/@creativebulma/bulma-tooltip/dist/bulma-tooltip.min.css"], "public/dist/css/bulma-tooltip.min.css")
    .styles(["node_modules/bulma-calendar/dist/css/bulma-calendar.min.css"], "public/dist/css/bulma-calendar.min.css")
    .styles(['node_modules/choices.js/public/assets/styles/choices.min.css'], 'public/dist/css/choices.min.css')
    .styles(
        ["node_modules/normalize.css/normalize.css"],
        "public/dist/css/normalize.css"
    )
    .js("node_modules/bulma-steps/dist/js/bulma-steps.min.js", "public/dist/js/bulma-steps.min.js")

    .js("resources/js/project-admin/create-task.js", "public/dist/js/create-task.js")
    .js('node_modules/choices.js/public/assets/scripts/choices.min.js', 'public/dist/js/choices.min.js')

    .js('resources/js/app.js', 'public/dist/js/app.js')
    .js('resources/js/calendar/index.js', 'public/dist/js/calendar.js')
