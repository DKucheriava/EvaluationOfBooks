const mix = require('laravel-mix');

mix.js('resources/js/bootstrap.js', 'resources/js')
    .js('resources/js/auth.js', 'public/js');


if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
