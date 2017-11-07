var path = "../wiki";
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var rename = require("gulp-rename");
var notify = require("gulp-notify");
var autoprefixer = require('gulp-autoprefixer');

gulp.task('serve', ['sass'], function () {

    browserSync.init({
        proxy: "wiki.superpatronen.local",
        notify: true
    });

    gulp.watch(path + "/scss/**/*.scss", ['sass']);
    gulp.watch(path + "/*.php").on('change', browserSync.reload);
});

gulp.task('sass', function () {
    return gulp.src(path + "/scss/**/*.scss")
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions', '> 5%', 'Firefox ESR', 'ie 6-8', 'IE 8'],
            cascade: true
        }))
        .pipe(rename("style.css"))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(path + "/"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);