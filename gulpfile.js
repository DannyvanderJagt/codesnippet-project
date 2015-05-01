// Dependencies.
var gulp			= require('gulp'),

	// Css.
	sass			= require('gulp-sass'),
	minify			= require('gulp-minify-css'),

	// Javascript.
	uglify			= require('gulp-uglify'),

	// Others.
	rename			= require('gulp-rename'),
	sequence		= require('run-sequence');

// File paths.
var files = {
	scss: 'src/assets/scss',
	distCss: 'src/public/dist/css',
	javascript: 'src/assets/javascript',
	distJavascript: 'src/public/dist/js'
};

/*************************/
/******  Css section *****/
/*************************/

// Convert the scss to css.
gulp.task('cssConvert', function(){
	return gulp.src(files.scss+'/*.scss')
	.pipe(sass())
	.pipe(gulp.dest(files.distCss));
});

// Minify the main.css file to main.min.css
gulp.task('cssMinify', function(){
	return gulp.src(files.css+'/main.css')
	.pipe(minify())
	.pipe(rename(function(path){
		path.basename += '.min';
	}))
	.pipe(gulp.dest(files.dist+'/css'));
});

// Watch the files for changes.
gulp.task('watch', function(){
	gulp.watch(files.scss+'/*.scss', ['css']);
	gulp.watch(files.javascript+'/*.js', ['javascript']);
});

/*************************/
/**  Javascript section **/
/*************************/
gulp.task('javascriptUglify', function(){
	return gulp.src(files.javascript+'/*.js')
	.pipe(uglify())
	.pipe(gulp.dest(files.distJavascript));
});

/*************************/
/******  Task Blocks *****/
/*************************/

gulp.task('default', function(){
	sequence('css', 'javascript', 'watch');
});

gulp.task('css', function(){
	sequence('cssConvert', 'cssMinify');
});

gulp.task('javascript', function(){
	sequence('javascriptUglify');
});