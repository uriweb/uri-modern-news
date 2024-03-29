const gulp = require( "gulp" );
const pkg = require( "./package.json" );

const banner = [ "/*",
	"Theme Name: <%= pkg.themeName %>",
	"Theme URI: <%= pkg.homepage %>",
	"Author: <%= pkg.author %>",
	"Author URI: <%= pkg.authorURI %>",
	"Description: <%= pkg.description %>",
	"Template: <%= pkg.template %>",
	"Version: <%= pkg.version %>",
	"License: <%= pkg.license %>",
	"License URI: <%= pkg.licenseURI %>",
	"Text Domain: <%= pkg.textDomain %>",
	"Tags: education, theme-options",
	"",
	"@version v<%= pkg.version %>",
	"@author <%= pkg.authorHuman %>",
	"",
	"*/",
	"" ].join( "\n" );

// Include plugins.

const eslint = require( "gulp-eslint" );
const changed = require( "gulp-changed" );
const concat = require( "gulp-concat" );
const terser = require( "gulp-terser" );
const sass = require( "gulp-sass" )(require("sass"));
const sourcemaps = require( "gulp-sourcemaps" );
const autoprefixer = require( "autoprefixer" );
const postcss = require( "gulp-postcss" );
const header = require( "gulp-header" );
const shell = require( "gulp-shell" );

// Options.
const sassOptions = {
	errLogToConsole: true,
	outputStyle: "compressed", //expanded, nested, compact, compressed
};

// JS concat, strip debugging and minify
gulp.task( "scripts", scripts );

function scripts(done) {
	gulp.src( "./src/js/*.js" )
		.pipe( eslint(done) )
		.pipe( eslint.format() )

	gulp.src( "./src/js/*.js" )
		.pipe( concat( "script.min.js" ) )
		.pipe( terser() )
		.pipe( header( banner, { pkg } ) )
		.pipe( gulp.dest( "./js/" ) );

	done();
	// console.log('scripts ran');
}

// Theme CSS concat, auto-prefix and minify
gulp.task( "styles", styles );

function styles(done) {
	gulp.src( "./src/sass/*.scss" )
		.pipe( sourcemaps.init() )
		.pipe( sass( sassOptions ).on( "error", sass.logError ) )
		.pipe( concat( "style.css" ) )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( header( banner, { pkg } ) )
		.pipe( sourcemaps.write( "./map" ) )
		.pipe( gulp.dest( "." ) );

	done();
	//console.log('styles ran');
}

// run codesniffer
gulp.task( "sniffs", sniffs );

function sniffs(done) {
	return gulp.src( ".", { read: false } )
		.pipe( shell( [ "./.sniff" ] ) );
}

// watch
gulp.task( "watcher", watcher );

function watcher(done) {
	// watch for JS changes
	gulp.watch( "./src/js/*.js", scripts );

	// watch for Theme CSS changes
	gulp.watch( "./src/sass/**/*", styles );

	// watch for PHP change
	gulp.watch( "./**/*.php", sniffs );

	done();
}

gulp.task( "default",
	gulp.parallel( "scripts", "styles", "sniffs", "watcher", function(done) {
		done();
	} )
);

function done() {
	//console.log( "done" );
}
