const { src, dest, series, watch } = require("gulp");
const server = require("browser-sync").create();

function serve(cb) {
  server.init({
    browser: "chrome",

    proxy: {
      target: "http://localhost:8888",
    },
  });
  cb();
}

function reload(cb) {
  server.reload();
  cb();
}

function copyTask() {
  return src(["src/**/*.php", "!src/vendor/**/{tests,squizlabs}/**"]).pipe(
    dest("dist")
  );
}

function watchTask() {
  watch(["src/**/*.php"], series(copyTask, reload));
}

exports.default = series(copyTask, serve, watchTask);
exports.copyTask = copyTask;
exports.serve = serve;
