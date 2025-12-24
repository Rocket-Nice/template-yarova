import gulp from "gulp";
import del from "del";
import browserSync from "browser-sync";

import sourcemaps from "gulp-sourcemaps";
import autoPrefixer from "gulp-autoprefixer";
import cleanCSS from "gulp-clean-css";
import rename from "gulp-rename";
import dartSass from "sass";
import gulpSass from "gulp-sass";
// import groupCssMediaQueries from "gulp-group-css-media-queries";
import replace from "gulp-replace";

const sass = gulpSass(dartSass);

export default function cssBuild() {
  del("./dist/css/**/style.css");
  console.log(app.path.build.css);
  return gulp
    .src(app.path.src.scss, { sourcemaps: app.isDev })
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(replace(/@img\//g, "../img/"))
    // .pipe(app.plugins.if(app.isProd, groupCssMediaQueries()))
    .pipe(
      app.plugins.if(
        app.isProd,
        autoPrefixer({
          grid: true,
          overrideBrowserslist: ["last 3 versions"],
        })
      )
    )
    .pipe(app.plugins.if(app.isDev, rename({ extname: ".css" })))
    .pipe(sourcemaps.write("../maps"))
    .pipe(gulp.dest(app.path.build.css))
    .pipe(browserSync.reload({ stream: true }));
}
