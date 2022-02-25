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

var sassPaths = [
  //  'bower_components/normalize.scss/sass',
    '../assets/css/*.scss'
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
      .pipe(dest('../assets/js/'));
    //  .pipe(browsersync.stream());
}

function css() {

  //  const source = sassPaths;
  const source = '../assets/css/*.scss';
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
        .pipe(dest('../assets/css/'));
      //  .pipe(browsersync.stream());
}


//exports.default = defaultTask
exports.default = series(parallel(js,css, defaultTask));
