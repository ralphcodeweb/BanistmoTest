const mix = require('laravel-mix');

mix.styles([
    'resources/vendor/plugins/fontawesome-free/css/all.min.css',
    'resources/vendor/adminlte/css/adminlte.min.css',
    'resources/vendor/adminlte/css/config.css'
], 'public/css/template.css')
.scripts([
    'resources/vendor/plugins/jquery/jquery.min.js',
    'resources/vendor/adminlte/js/adminlte.min.js',
    'resources/vendor/adminlte/js/demo.js',
], 'public/js/template.js')
.copy('resources/vendor/plugins/fontawesome-free/webfonts', 'public/webfonts')
.copy('resources/vendor/adminlte/img', 'public/img')
.js('resources/js/app.js', 'public/js')
.vue();