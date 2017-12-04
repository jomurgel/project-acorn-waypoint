<center><img src="https://jomurgel.com/cdn/acorn.png" alt="Acorn Logo"></center>

# Project Acorn Theme
A theme waypoint between WordPress, its REST API and the [https://github.com/jomurgel/project-acorn-ssr](Project Acorn Vue SSR).

## What is this for?
It is a SUPER barebones theme intended ONLY to be used to give some extra functionality to our WordPress REST API waypoint and setup a few defaults and helpers along the way. This theme was built as a dev helper and not as a user-face or standard WordPress theme.  It is indended to be used along side my [https://github.com/jomurgel/project-acorn-ssr](Project Acorn Vue SPA) (or any SPA) which utilizes the WordPress REST API.

## What does this include?
- This theme provides only a splash page or user redirect (toggle in Settings) to the admin login page if a user is not logged in.
- Provides at-a-glance output of the REST API when logged in.
- Provides bare-bones output of page/post previews + some helper notes.
- Forces the standard `/%postname%/` permalink structure out of the box.
- Adds custom menu endpoints for easy access to the WordPress menu (info below).
- Removes the customizer functionality, because who needs it, I mean, really? This code forked from [https://github.com/parallelus/customizer-remove-all-parts](Customizer Remove All Parts).
- Adds theme support for `post_thumbnail`.
- Registers WordPress menu: `Main Menu`.
- Style Reset with [https://jonathantneal.github.io/sanitize.css/](sanitize.scss).
- Base styles with [http://getskeleton.com/](skeleton.scss).
- gulpfile.js with style compiling + svg icon compiling.
- custom acorn color scheme — set by default.

### Menu Endpoints
- Custom Menu Endpoints in `inc/menu-endpoints.php`.
- Can use `/wp-api-menus/v2/menus` for an array of menu slugs, ids and items.
- Can use `/wp-api-menus/v2/menus/id` or `wp-api-menus/v2/menus/slug` to get individual menus data.

## Development
Run `npm install` to install dependencies.
