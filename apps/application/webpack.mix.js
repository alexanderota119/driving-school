const mix = require('laravel-mix');
const { browserSync } = require('laravel-mix');
const path = require('path');

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

mix.disableNotifications();
mix.sass('resources/sass/app.scss', 'public/css').version();
mix.ts('resources/js/app.ts', 'public/js').vue({ version: 3 }).version();

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                loader: 'ts-loader',
                options: { appendTsSuffixTo: [/\.vue$/] },
                exclude: /node_modules/,
            },
        ],
    },

    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },

        extensions: ['.tsx', '.ts', '.js'],
    },

    devServer: {
        allowedHosts: 'all',
    },
});

browserSync({
    proxy: 'http://bar.eddriving.local:8000/',
    host: 'bar.eddriving.local',
    open: false,
});
