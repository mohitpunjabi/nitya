var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less', 'resources/css');

    mix.scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'select2.min.js',
        'product-select2.js',
        'stickyNav.js',
        'magnifier.js',
        'jquery.bgswitcher.js',
        'app.js'
    ], 'public/js/app.js', './resources/js');

    mix.styles([
        'app.css',
        'select2.min.css'
    ], 'public/css/app.css', './resources/css');

    mix.version(['css/app.css', 'js/app.js']);

});
