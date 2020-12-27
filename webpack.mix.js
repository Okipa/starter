const mix = require('laravel-mix');

// Fix found here to avoid custom files versioning issue : https://github.com/JeffreyWay/laravel-mix/issues/1193.
mix.copyDirectoryOutsideMixWorkflow = function (from, to) {
    new File(from).copyTo(new File(to).path());
    return this;
}.bind(mix);

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

mix
    .copy('resources/favicon.ico', 'public/favicon.ico')
    .copyDirectoryOutsideMixWorkflow('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts/fontawesome')
    .copyDirectoryOutsideMixWorkflow('resources/images', 'public/images')

    // JS **************************************************************************************************************
    // Admin
    .js('resources/js/templates/admin/brickables/carousel/edit.js', 'public/js/templates/admin/brickables/carousel')
    .js('resources/js/templates/admin/library-media/index.js', 'public/js/templates/admin/library-media')
    .js('resources/js/templates/admin/library-media/edit.js', 'public/js/templates/admin/library-media')
    // Front
    //
    // Brickables
    .js('resources/js/brickables/carousel.js', 'public/js/brickables')
    // Base
    .js('resources/js/global/admin.js', 'public/js/admin.js')
    .js('resources/js/global/front.js', 'public/js/front.js')

    // SASS ************************************************************************************************************
    // Admin
    //
    // Front
    .sass('resources/sass/templates/front/news/page/show.scss', 'public/css/templates/front/news/page')
    .sass('resources/sass/templates/front/contact/page/show.scss', 'public/css/templates/front/contact/page')
    // Brickables
    .sass('resources/sass/brickables/carousel.scss', 'public/css/brickables')
    // Base
    .sass('resources/sass/global/_admin.scss', 'public/css/admin.css')
    .sass('resources/sass/global/_front.scss', 'public/css/front.css')

    // Config **********************************************************************************************************
    .webpackConfig({
        module: {
            rules: [
                {
                    enforce: 'pre',
                    test: /\.(js)$/,
                    loader: 'eslint-loader',
                    exclude: /node_modules/
                }
            ]
        }
    })
    .options({processCssUrls: false})
    .autoload({
        lodash: ['_'],
        axios: ['axios'],
        jquery: ['$', 'jQuery', 'window.jQuery'],
        'popper.js': ['Popper'],
        cookieconsent: ['cookieconsent', 'window.cookieconsent'],
    })
    .extract(['bootstrap', 'lodash', 'axios', 'jquery', 'popper.js', 'cookieconsent', 'masonry-layout', 'glightbox'])
    .sourceMaps()
    .version([
        'public/images/',
        'public/favicon.ico'
    ]);

if (mix.inProduction()) {
    mix.disableNotifications();
}
