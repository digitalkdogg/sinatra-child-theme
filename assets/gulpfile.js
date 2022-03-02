const {
    src,
    dest,
    parallel,
    series,
    watch
} = require('gulp');

const uglify = require('gulp-uglify');
const changed = require('gulp-changed');
const concat = require('gulp-concat');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
const cssnano = require('gulp-cssnano');

//const clean = require('gulp-clean');

var sassPaths = [
  //  'bower_components/normalize.scss/sass',
    './css/*.scss'
];

function defaultTask(cb) {
  // place code for your default task here
  cb();
}

function js() {
  const source = '../assets/js/*.js';

  return src(source)
      .pipe(changed(source))
      .pipe(concat('base.min.js'))
      .pipe(uglify())
      .pipe(dest('../assets/js/min', {overwrite:true}))

}

function donatejs() {
  const source = '../assets/js/donate/*.js';

  return src(source)
      .pipe(changed(source))
      .pipe(concat('donate.min.js'))
      .pipe(uglify())
      .pipe(dest('../assets/js/min', {overwrite:true}))

}

function newsjs() {
  const source = '../assets/js/news/*.js';

  return src(source)
      .pipe(changed(source))
      .pipe(concat('news.min.js'))
      .pipe(uglify())
      .pipe(dest('../assets/js/min', {overwrite:true}))

}

function css() {

  //  const source = sassPaths;
  const source = './css/*.scss';
    //return src(source)
    return src(source)
        .pipe(changed(source))
        .pipe(sass({includePaths: sassPaths, outputStyle: 'compressed' }))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(rename({
            extname: '.css'
        }))
        .pipe(cssnano())
        .pipe(dest('./css/'));
      //  .pipe(browsersync.stream());
}

function donatecss() {

  //  const source = sassPaths;
  const source = './css/donate/*.scss';
    //return src(source)
    return src(source)
        .pipe(changed(source))
        .pipe(sass({includePaths: sassPaths, outputStyle: 'compressed' }))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(rename({
            extname: '.css'
        }))
        .pipe(cssnano())
        .pipe(dest('./css/'));
      //  .pipe(browsersync.stream());
}

function newscss() {

  //  const source = sassPaths;
  const source = './css/news/*.scss';
    //return src(source)
    return src(source)
        .pipe(changed(source))
        .pipe(sass({includePaths: sassPaths, outputStyle: 'compressed' }))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(rename({
            extname: '.css'
        }))
        .pipe(cssnano())
        .pipe(dest('./css/'));
      //  .pipe(browsersync.stream());
}



//exports.default = defaultTask
//exports.task(clear);
exports.default = series(parallel(js,donatejs,donatecss, newsjs,newscss, css, defaultTask));
