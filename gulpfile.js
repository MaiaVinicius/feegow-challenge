const { src, dest } = require('gulp');
const uglify = require('gulp-uglify-es').default;

function defaultTask(cb) {
    return src('assets/js/**/*')
        .pipe(uglify())
        .pipe(dest('public/assets/js'));
}

exports.default = defaultTask;
