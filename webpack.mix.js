const mix = require('laravel-mix');

// fix found here to avoid custom files versioning issue : https://github.com/JeffreyWay/laravel-mix/issues/1193
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
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy('resources/favicon.ico', 'public/favicon.ico')
    .copyDirectoryOutsideMixWorkflow('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts/fontawesome')
    .copyDirectoryOutsideMixWorkflow('resources/images', 'public/images')
    // js **************************************************************************************************************
    // admin
    .js('resources/js/admin/library-media/index.js', 'public/js/library-media')
    .js('resources/js/admin/library-media/edit.js', 'public/js/library-media')
    // front
    //
    // base
    .js('resources/js/scripts/admin/base.js', 'public/js/admin.js')
    .js('resources/js/scripts/front/base.js', 'public/js/front.js')
    // sass ************************************************************************************************************
    // admin
    //
    // front
    .sass('resources/sass/front/home/page/show.scss', 'public/css/home/page')
    .sass('resources/sass/front/news/index.scss', 'public/css/news')
    .sass('resources/sass/front/news/show.scss', 'public/css/news')
    .sass('resources/sass/front/contact/page/show.scss', 'public/css/contact/page')
    .sass('resources/sass/front/simple-pages/show.scss', 'public/css/simple-pages')
    // base
    .sass('resources/sass/styles/admin/_base.scss', 'public/css/admin.css')
    .sass('resources/sass/styles/front/_base.scss', 'public/css/front.css')
    // config **********************************************************************************************************
    .options({processCssUrls: false})
    .autoload({
        lodash: ['_'],
        axios: ['axios'],
        jquery: ['$', 'jQuery', 'window.jQuery'],
        'popper.js': ['Popper'],
        'sweetalert2': ['swal'],
        cookieconsent: ['cookieconsent', 'window.cookieconsent'],
        lozad: ['lozad']
    })
    .extract(['bootstrap', 'lodash', 'axios', 'jquery', 'popper.js', 'sweetalert2', 'cookieconsent', 'lozad'])
    .sourceMaps()
    .version([
        'public/images/',
        'public/favicon.ico'
    ]);

if (mix.inProduction()) {
    mix.disableNotifications();
}
