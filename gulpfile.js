const { src, dest, series, watch } = require("gulp");
const server = require("browser-sync").create();


function serve(cb) {
	server.init(
		{
			open: false,

			proxy: {
				target: "http://localhost:8888",
			},
		}
	);
	cb();
}

function reload(cb) {
	server.reload();
	cb();
}

function copyTask() {
	return src(["src/**/*.php", "!src/vendor/**/{tests,squizlabs,phpcsstandards,dealerdirect,wp-coding-standards}/**"]).pipe(
		dest("dist")
	);
}

function watchTask() {
	// watch(["src/**/*.php"], series(copyTask, reload));
	watch(["src/**/*.php"], series(reload));
}

// exports.default = series(copyTask, serve, watchTask);
exports.default = series(serve, watchTask);
exports.copyTask = copyTask;
exports.serve = serve;
exports.watchTask = watchTask;
