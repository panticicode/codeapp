const { mix } = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
mix.styles([
	'resources/assets/css/libs/blog-post.css',
	'resources/assets/css/libs/bootstrap.css',
	'resources/assets/css/libs/font-awesome.css',
	'resources/assets/css/libs/metisMenu.css',
	'resources/assets/css/libs/sb-admin-2.css'	
], 'public/css/libs.css');
mix.scripts([
	'resources/assets/css/libs/jquery.js',
	'resources/assets/css/libs/bootstrap.js',
	'resources/assets/css/libs/metisMenu.js',
	'resources/assets/css/libs/sb-admin-2.js',	
	'resources/assets/css/libs/scripts.js',	
], 'public/js/libs.js');