var gulp = require('gulp');
	sass = require('gulp-sass');
	browserSync = require('browser-sync');
	watch = require('gulp-watch');
	util = require('gulp-util');
	notify = require('gulp-notify');
	sourcemaps = require('gulp-sourcemaps');

gulp.task('frontend', function(){
	return gulp.src('resources/assets/sass/styles.scss')
	.pipe(sourcemaps.init())
	.pipe(sass())
	.pipe(sourcemaps.write())
	.pipe(gulp.dest('public/assets/css'))
	.pipe(browserSync.stream())
	.pipe(notify('sass complete'));
});

gulp.task('servef', ['frontend'], function() {

	browserSync.init({
		proxy: "http://localhost/egor/public/"
	});

	gulp.watch("resources/assets/sass/*.scss", ['frontend']);
	gulp.watch("resources/views/**/**").on('change', browserSync.reload);
	notify('view complete');
});

gulp.task('serveb', ['backend'], function() {

	browserSync.init({
		proxy: "http://localhost/egor/public/"
	});

	gulp.watch("resources/assets/sass/*.scss", ['backend']);
	gulp.watch("resources/views/**/**").on('change', browserSync.reload).pipe(notify('view complete'));
});

gulp.task('default', ['servef']);