const mix = require('laravel-mix');

/**
 * Vue Hot Reloading
 */
mix.options({
    hmrOptions: {
        host: 'localhost',  // site's host name
        port: 8080,
    }
});
// fix css files 404 issue
mix.webpackConfig({
    // add any webpack dev server config here
    devServer: {
        proxy: {
            host: '0.0.0.0',  // host machine ip
            port: 8080,
        },
        // watchOptions:{
        //     aggregateTimeout:200,
        //     poll:5000
        // },

    }
});

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

mix.js('resources/js/app.js', 'public/js').vue()
   .sass('resources/sass/app.scss', 'public/css');

var ExtractTextPlugin = require('mini-css-extract-plugin');

if (mix.inProduction()) {
    const ASSET_URL = process.env.ASSET_URL + "/";

    mix.webpackConfig(webpack => {
        return {
            plugins: [
                new webpack.DefinePlugin({
                    "process.env.ASSET_PATH": JSON.stringify(ASSET_URL)
                }),
                new ExtractTextPlugin()
            ],
            output: {
                publicPath: ASSET_URL
            }
        };
    });
}
