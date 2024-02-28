const mix = require('laravel-mix');

mix.stylus('resources/stylus/app.styl', 'public/css')
    .options({
        stylus: {
            'resolve url': true,
            'include css': true,
            compress: true,
        },
        postCss: [
            require('autoprefixer'),
        ],
    })
    .version();

mix.css('public/css/bootstrap.css', 'public/css/bootstrap.css')
.options({
    postCss: [
        require('cssnano')({
            preset: 'default',
        }),
    ],
})
.version();

mix.css('public/css/fonts.css', 'public/css/fonts.css')
.options({
    postCss: [
        require('cssnano')({
            preset: 'default',
        }),
    ],
})
.version();


mix.combine([
    'public/css/bootstrap.min.css', 
    'public/css/fonts.css',
    'public/css/app.css',
], 'public/css/main.css')
.version();


//java script
mix.js('resources/js/app.js', 'js').vue();

mix.combine([
    'public/js/bootstrap.min.js',
    'public/js/app.js',
], 'public/js/main.js')
.version();