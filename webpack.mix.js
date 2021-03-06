let mix = require('laravel-mix');

require('laravel-mix-criticalcss');
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
// mix.options({
// 	processCssUrls: true
// });

mix
	.js([
		'resources/assets/js/app.js'
	], 'public/js')
	.vue();
mix
	.sass('resources/assets/sass/app.scss', 'public/css')
	.criticalCss({
	    enabled: mix.inProduction(),
	    paths: {
	        base: 'https://diskremont.ru/',
	        templates: './public/css/'
	    },
	    urls: [
	        { url: '/', template: 'home' },
	        { url: 'uslugi.html', template: 'uslugi' },
	        { url: 'pokraska.html', template: 'uslugi_detail' },
	        { url: 'price.html', template: 'price' },
	        { url: 'galmenu.html', template: 'galmenu' },
	    ],
	    options: {
	        minify: true,
	        ignore: [
	            /url\(/,
	            /@import/,
	            '@font-face',
	            /print/,
	            /\.navbar\-toggler\-icon/
	        ]
	    },
	})
	.browserSync('http://drem.loc/');

mix.js('resources/assets/js/admin.js', 'public/js');

mix.js('resources/assets/js/libs/canvg.js', 'public/js');

if (mix.inProduction()) {
	mix.version();
}

if (!mix.inProduction()) {
	mix.sourceMaps();
}


