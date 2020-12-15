const mix = require('laravel-mix');
require('laravel-mix-svelte');
// import sveltePreprocess from 'svelte-preprocess';
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

mix.svelte({
        dev: !mix.inProduction(),
        emitCss: true,
        preprocess: require("svelte-preprocess")({
            postcss: {
                plugins: [
                    require("tailwindcss"),
                    require("postcss-preset-env")({
                        /* use stage 3 features + css nesting rules */
                        stage: 3,
                        features: {
                            'nesting-rules': true
                        }
                    })
                ]
            }
        })
    })
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.pcss', 'public/css', [
        require("tailwindcss"),
        require("postcss-preset-env")({
            /* use stage 3 features + css nesting rules */
            stage: 3,
            features: {
                'nesting-rules': true
            }
        })
    ])
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]',
        },
    })
    .version();