![acorn](https://user-images.githubusercontent.com/5230729/33617107-17ebf23c-d99c-11e7-8aa6-ec559bd23027.png)

# Project Acorn Theme
A theme waypoint between WordPress, its REST API and the [Project Acorn SSR](https://github.com/jomurgel/project-acorn-ssr).

## What is this for?
It is a SUPER bare bones theme intended ONLY to be used to give some extra functionality to our WordPress REST API waypoint and setup a few defaults and helpers along the way. This theme was built as a dev helper and not as a user-face or standard WordPress theme.  It is intended to be used along side my [Project Acorn SSR](https://github.com/jomurgel/project-acorn-ssr) or any SPA which utilizes the WordPress REST API.

## What does this include?
- This theme provides only a splash page or user redirect (toggle in Settings) to the admin login page if a user is not logged in.
- Provides at-a-glance output of the REST API when logged in.
- Provides bare-bones output of page/post previews + some helper notes.
- Forces the standard `/%postname%/` permalink structure out of the box.
- Adds custom menu endpoints for easy access to the WordPress menu (info below).
- Removes the customizer functionality, because who needs it, I mean, really? This code forked from [Customizer Remove All Parts](https://github.com/parallelus/customizer-remove-all-parts).
- Adds theme support for `post_thumbnail`.
- Registers WordPress menu: `Main Menu`.
- Style Reset with [sanitize.scss](https://jonathantneal.github.io/sanitize.css/).
- Base styles with [skeleton.scss](http://getskeleton.com/).
- gulpfile.js with style compiling + svg icon compiling + [BrowserSync](https://www.browsersync.io/).
- custom acorn color scheme — set by default.

### Menu Endpoints
- Custom Menu Endpoints in `inc/menu-endpoints.php`.
- Can use `/wp-api-menus/v2/menus` for an array of menu slugs, ids and items.
- Can use `/wp-api-menus/v2/menus/id` or `wp-api-menus/v2/menus/slug` to get individual menus data.

## Development
- Install: `npm install` to install dependencies.
- Run `gulp watch` to run with BrowserSync + active compiling.
- Run `gulp icons` to compile SVG Icons.
- Run `gulp styles` to compile, autoprefix, and minify main `style.scss` and `colors.scss`.

## License
[MIT](http://opensource.org/licenses/MIT)
