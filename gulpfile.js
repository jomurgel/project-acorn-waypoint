// Require our dependencies
const autoprefixer = require( 'autoprefixer' ),
      browserSync  = require( 'browser-sync' ),
      cheerio      = require( 'gulp-cheerio' ),
      cssnano      = require( 'gulp-cssnano' ),
      del          = require( 'del' ),
      fs           = require( 'fs' ),
      gulp         = require( 'gulp' ),
      gutil        = require( 'gulp-util' ),
      mqpacker     = require( 'css-mqpacker' ),
      notify       = require( 'gulp-notify' ),
      plumber      = require( 'gulp-plumber' ),
      postcss      = require( 'gulp-postcss' ),
      reload       = browserSync.reload,
      rename       = require( 'gulp-rename' ),
      sass         = require( 'gulp-sass' ),
      sassLint     = require( 'gulp-sass-lint' ),
      sort         = require( 'gulp-sort' ),
      sourcemaps   = require( 'gulp-sourcemaps' ),
      svgmin       = require( 'gulp-svgmin' ),
      svgstore     = require( 'gulp-svgstore' ),
      wpPot        = require( 'gulp-wp-pot' );

// Set assets paths.
const paths = {
  'css': [ './*.css', '!*.min.css' ],
  'icons': 'assets/svg/icons/*.svg',
  'php': [ './*.php', './**/*.php' ],
  'sass': 'assets/scss/**/*.scss',
  'theme': 'assets/theme/colors.scss'
};

/**
 * Handle errors and alert the user.
 */
function handleErrors() {
  const args = Array.prototype.slice.call( arguments );

  notify.onError( {
    'title': 'Task Failed [<%= error.message %>',
    'message': 'See console.',
    'sound': 'Sosumi' // See: https://github.com/mikaelbr/node-notifier#all-notification-options-with-their-defaults
  } ).apply( this, args );

  gutil.beep(); // Beep 'sosumi' again.

  // Prevent the 'watch' task from stopping.
  this.emit( 'end' );
}

/**
 * Delete style.css and style.min.css before we minify and optimize
 */
gulp.task( 'clean:styles', () =>
  del( [ 'style.css', 'style.min.css' ] )
);

/**
 * Compile Sass and run stylesheet through PostCSS.
 *
 * https://www.npmjs.com/package/gulp-sass
 * https://www.npmjs.com/package/gulp-postcss
 * https://www.npmjs.com/package/gulp-autoprefixer
 * https://www.npmjs.com/package/css-mqpacker
 */
gulp.task( 'postcss', [ 'clean:styles' ], () =>
  gulp.src( 'assets/scss/*.scss', paths.css )

    // Deal with errors.
    .pipe( plumber( {'errorHandler': handleErrors} ) )

    // Wrap tasks in a sourcemap.
    .pipe( sourcemaps.init() )

      // Compile Sass using LibSass.
      .pipe( sass( {
        'errLogToConsole': true,
        'outputStyle': 'expanded' // Options: nested, expanded, compact, compressed
      } ) )

      // Parse with PostCSS plugins.
      .pipe( postcss( [
        autoprefixer( {
          'browsers': [ 'last 2 version' ]
        } ),
        mqpacker( {
          'sort': true
        } )
      ] ) )

    // Create sourcemap.
    .pipe( sourcemaps.write() )

    // Create style.css.
    .pipe( gulp.dest( './' ) )
    .pipe( browserSync.stream() )
);

/**
 * Minify and optimize style.css.
 *
 * https://www.npmjs.com/package/gulp-cssnano
 */
gulp.task( 'cssnano', [ 'postcss' ], () =>
  gulp.src( 'style.css' )
    .pipe( plumber( {'errorHandler': handleErrors} ) )
    .pipe( cssnano( {
      'safe': true // Use safe optimizations.
    } ) )
    .pipe( rename( 'style.min.css' ) )
    .pipe( gulp.dest( './' ) )
    .pipe( browserSync.stream() )
);

/**
 * Delete style.css and style.min.css before we minify and optimize
 */
gulp.task( 'clean:theme', () =>
  del( [ 'assets/theme/colors.css', 'assets/theme/colors.min.css' ] )
);

/**
 * Compile Sass and run stylesheet through PostCSS.
 *
 * https://www.npmjs.com/package/gulp-sass
 * https://www.npmjs.com/package/gulp-postcss
 * https://www.npmjs.com/package/gulp-autoprefixer
 * https://www.npmjs.com/package/css-mqpacker
 */
gulp.task( 'themecss', [ 'clean:theme' ], () =>
  gulp.src( paths.theme )

    // Deal with errors.
    .pipe( plumber( {'errorHandler': handleErrors} ) )

    // Wrap tasks in a sourcemap.
    .pipe( sourcemaps.init() )

      // Compile Sass using LibSass.
      .pipe( sass( {
        'errLogToConsole': true,
        'outputStyle': 'expanded' // Options: nested, expanded, compact, compressed
      } ) )

      // Parse with PostCSS plugins.
      .pipe( postcss( [
        autoprefixer( {
          'browsers': [ 'last 2 version' ]
        } ),
        mqpacker( {
          'sort': true
        } )
      ] ) )

    // Create sourcemap.
    .pipe( sourcemaps.write() )

    // Create style.css.
    .pipe( gulp.dest( 'assets/theme/' ) )
    .pipe( browserSync.stream() )
);

/**
 * Minify and optimize style.css.
 *
 * https://www.npmjs.com/package/gulp-cssnano
 */
gulp.task( 'themenano', [ 'themecss' ], () =>
  gulp.src( 'assets/theme/colors.css' )
    .pipe( plumber( {'errorHandler': handleErrors} ) )
    .pipe( cssnano( {
      'safe': true // Use safe optimizations.
    } ) )
    .pipe( rename( 'colors.min.css' ) )
    .pipe( gulp.dest( 'assets/theme/' ) )
    .pipe( browserSync.stream() )
);

/**
 * Delete the icons.svg before we minify, concat.
 */
gulp.task( 'clean:icons', () =>
  del( [ 'assets/svg/icons.svg' ] )
);

/**
 * Minify, concatenate, and clean SVG icons.
 *
 * https://www.npmjs.com/package/gulp-svgmin
 * https://www.npmjs.com/package/gulp-svgstore
 * https://www.npmjs.com/package/gulp-cheerio
 */
gulp.task( 'svg', [ 'clean:icons' ], () =>
  gulp.src( paths.icons )

    // Deal with errors.
    .pipe( plumber( {'errorHandler': handleErrors} ) )

    // Minify SVGs.
    .pipe( svgmin() )

    // Add a prefix to SVG IDs.
    .pipe( rename( {'prefix': 'icon-'} ) )

    // Combine all SVGs into a single <symbol>
    .pipe( svgstore( {'inlineSvg': true} ) )

    // Clean up the <symbol> by removing the following cruft...
    .pipe( cheerio( {
      'run': function( $, file ) {
        $( 'svg' ).attr( 'style', 'display:none' );
        // $( '[fill]' ).removeAttr( 'fill' );
        // $( 'path' ).removeAttr( 'class' );
        $( 'title' ).remove();
      },
      'parserOptions': {'xmlMode': true}
    } ) )

    // Save icons.svg.
    .pipe( rename( 'icons.svg' ) )
    .pipe( gulp.dest( 'assets/svg/' ) )
    .pipe( browserSync.stream() )
);

/**
 * Delete the theme's .pot before we create a new one.
 */
gulp.task( 'clean:pot', () =>
  del( [ 'languages/acorn.pot' ] )
);

/**
 * Scan the theme and create a POT file.
 *
 * https://www.npmjs.com/package/gulp-wp-pot
 */
gulp.task( 'wp-pot', [ 'clean:pot' ], () =>
  gulp.src( paths.php )
    .pipe( plumber( {'errorHandler': handleErrors} ) )
    .pipe( sort() )
    .pipe( wpPot( {
      'domain': 'acorn',
      'package': 'acorn'
    } ) )
    .pipe( gulp.dest( 'languages/acorn.pot' ) )
);

/**
 * Sass linting.
 *
 * https://www.npmjs.com/package/sass-lint
 */
gulp.task( 'sass:lint', () =>
  gulp.src( [
    'assets/scss/**/*.scss',
    'assets/theme/*.scss',
    '!node_modules/**'
  ] )
    .pipe( sassLint() )
    .pipe( sassLint.format() )
    .pipe( sassLint.failOnError() )
);

/**
 * Process tasks and reload browsers on file changes.
 *
 * https://www.npmjs.com/package/browser-sync
 */
gulp.task( 'watch', function() {

  // Kick off BrowserSync.
  browserSync( {
    'open': false,             // Open project in a new tab?
    'injectChanges': true,     // Auto inject changes instead of full reload.
    'proxy': 'https://wordpress.test',
    'watchOptions': {
      'debounceDelay': 500  // Wait 1 second before injecting.
    }
  } );

  // Run tasks when files change.
  gulp.watch( paths.icons, [ 'icons' ] );
  gulp.watch( paths.theme, [ 'theme' ] );
  gulp.watch( paths.sass, [ 'styles' ] );
  gulp.watch( paths.php, [ 'markup' ] );
} );

/**
 * Create individual tasks.
 */
gulp.task( 'markup', browserSync.reload );
gulp.task( 'icons', [ 'svg' ] );
gulp.task( 'styles', [ 'cssnano' ] );
gulp.task( 'theme', [ 'themenano' ] );
gulp.task( 'lint', [ 'sass:lint' ] );
gulp.task( 'default', [ 'icons', 'styles' ] );
