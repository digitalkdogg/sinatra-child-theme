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

const clean = require('gulp-clean');

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
      .pipe(dest('../assets/min/js/', {overwrite:true}))
      .on('before', function (sourcemin) {
      //  sourcemin.pipe(clean());
      })

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

function clear() {
  console.log('i am clear');
  const source = '../assets/js/*.min.js';
  return src(source).pipe(clean());
}


//exports.default = defaultTask
//exports.task(clear);
exports.default = series(parallel(js,css, defaultTask));
