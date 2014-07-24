var gulp 		= require('gulp');
var gutil 		= require('gulp-util');
var concat 		= require('gulp-concat');
var sass 		= require('gulp-ruby-sass');
var sys 		= require('gulp-imagemin');
var rename 		= require('gulp-rename');
var clean 		= require('gulp-clean');
var uglify 		= require ('gulp-uglify');
var livereload	= require('gulp-livereload');
var autoprefix 	= require('gulp-autoprefixer');
var imagemin 	= require('gulp-imagemin');

var sassDir 		= 'sass';
var jsDir 			= 'scripts';
var jqPluginDir 	= 'scripts/plugins';
var jqLibsDir 		= 'scripts/libs';
var imgOrigDir		= 'images_orig';
var publicDir 		= '../';
var targetCssDir 	= '../css';
var targetJsDir 	= '../js';
var targetJsLibDir 	= '../js/lib';
var targetFontsDir 	= '../fonts';
var targetImgDir	= '../images';
var appViews		= '../../app/views/**/*.php';

var bowerDir 		= 'bower_resources';
var bootstrapDir 	= '/bootstrap-sass-official/vendor/assets';
var fontawesomDir 	= '/font-awesome';
var modernizrDir 	= '/modernizr';
var momentDir 		= '/moment';
var jqueryDir 		= '/jquery/dist';
var underscoreDir 	= '/underscore';

/**
 * START TASK - moving fonts
 */

gulp.task('start', [
	'move_font_awesome',
	'move_font_bootstrap',
	'modernizr_ugly',
	'moment_ugly',
	'jquery_ugly',
	'underscore_ugly',
	'knockout_ugly',
	'bootstrap_concat_ugly',
]);

// Move fonts to /public/fonts
gulp.task('move_font_awesome', function() {
	return gulp.src([
		bowerDir + fontawesomDir + '/fonts/*.*',
	])
		.pipe(gulp.dest(targetFontsDir));
});

gulp.task('move_font_bootstrap', function() {
	return gulp.src([
		bowerDir + bootstrapDir + '/fonts/**'
	])
		.pipe(gulp.dest(targetFontsDir));
});

// Uglify Modernizer js
gulp.task('modernizr_ugly', function() {
	return gulp.src(bowerDir + modernizrDir + '/modernizr.js')
		.pipe(rename('modernizr.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

// Uglify Moment js
gulp.task('moment_ugly', function() {
	return gulp.src(bowerDir + momentDir + '/moment.js')
		.pipe(rename('moment.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

// Uglify and move jQuery
gulp.task('jquery_ugly', function() {
	return gulp.src(bowerDir + jqueryDir + '/jquery.js')
		.pipe(rename('jquery.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

// Uglify and move underscore
gulp.task('underscore_ugly', function() {
	return gulp.src(bowerDir + underscoreDir + '/underscore.js')
		.pipe(rename('underscore.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

// Uglify and move underscore
gulp.task('knockout_ugly', function() {
	return gulp.src(jqLibsDir + '/knockout-3.1.0.js')
		.pipe(rename('knockout.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

// Concat and Uglify Bootstrap js
gulp.task('bootstrap_concat_ugly', function() {
	return gulp.src([
		bowerDir + bootstrapDir + '/javascripts/bootstrap/affix.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/alert.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/button.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/carousel.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/collapse.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/dropdown.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/tab.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/transition.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/scrollspy.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/modal.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/tooltip.js',
		bowerDir + bootstrapDir + '/javascripts/bootstrap/popover.js'
	])
		.pipe(concat('bootstrap.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsLibDir));
});

/**
 * DEFAULT TASK - gulp
 */

gulp.task('default', ['styles', 'plugins', 'script', 'images', 'watch']);

// Compile plugins
gulp.task('plugins', function() {
	return gulp.src(jqPluginDir + '/*.js')
		.pipe(concat('plugins.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsDir));
});

// Uglify and move script.js
gulp.task('script', function() {
	return gulp.src(jsDir + '/ambientdesk.js')
		.pipe(concat('ambientdesk.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(targetJsDir));
});

gulp.task('images', function () {
        gulp.src(imgOrigDir + '/*.{png,gif,jpg}')
        .pipe(imagemin())
        .pipe(gulp.dest(targetImgDir));
});

// Task Sass
gulp.task('styles', function () {
	gulp.src(sassDir + '/styles.scss')
		.pipe(sass({style: 'compressed'}).on('error', gutil.log))
		.pipe(autoprefix('last 10 version'))
		.pipe(gulp.dest(targetCssDir))
		.pipe(livereload());
});

// Task watch
gulp.task('watch', function () {
	var server = livereload();

    gulp.watch(sassDir + '/**/*.scss', ['styles']);
    gulp.watch(jsDir + '/**/*.js', ['script']);
    gulp.watch(jqPluginDir + '/*.js', ['plugins']);
    gulp.watch(imgOrigDir + '/**', ['images']);
    gulp.watch(appViews).on('change', function(file) {
    	server.changed(file.path);
    });
});