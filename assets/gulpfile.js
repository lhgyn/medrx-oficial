
const gulp = require('gulp');

/* IMG Requires */
const imagemin = require('gulp-imagemin');

/* CSS Requires */
var cssmin = require('gulp-cssmin');

/* JS Requires */
var uglify = require('gulp-uglify');
var pipeline = require('readable-stream').pipeline;

/* Global Requires */
var rename = require('gulp-rename');
var concat = require('gulp-concat');


gulp.task('image-clean', () =>
    gulp.src('../images/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('../images/news'))
);

gulp.task('css-min', function () {
    gulp.src([
        './libs/bootstrap4/css/bootstrap.min.css',
        './css/rubik.font.css',
        './css/header.css',
        './css/footer.css',
        './css/loja.css',
        './css/products.css',
        './css/cart.css',
        './css/home.css',
        './css/main.css',
        './css/blog.css',
        './css/newsletter.css',
        './css/selos.css',
        './css/woocommerce.css',
        './css/checkout.css',
        './libs/font-awesome-4.7/css/font-awesome.css',
        './libs/animate/animate.css',
        './libs/hover-effects/set1.css',
        './libs/hover-effects/set2.css',
        './libs/owl-carousel/assets/owl.carousel.min.css',
      ])
      .pipe(cssmin())
      .pipe(concat('__all-styles.min.css'))
      .pipe(gulp.dest('./css'));
});

gulp.task('js-min', function () {
    gulp.src([
        './js/jquery-3.3.1.min.js',
        './libs/bootstrap4/js/bootstrap.min.js',
        './libs/font-awesome5/js/all.min.js',
        './libs/inputmask/jquery.mask.min.js',
        './libs/owl-carousel/owl.carousel.min.js',
        './js/custom.js',
        './js/products.js',
        './js/main.js',
        './js/jquery-3.3.1.min.js',
      ])
      .pipe(uglify())
      .pipe(concat('__all-scripts.min.js'))
      .pipe(gulp.dest('./js'))
});

function defaultTask(cb) {
  // place code for your default task here
  cb( 'css-min', 'js-min' );
}

exports.default = defaultTask