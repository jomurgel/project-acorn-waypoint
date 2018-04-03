<p align="center">
	<img src="https://user-images.githubusercontent.com/5230729/33617107-17ebf23c-d99c-11e7-8aa6-ec559bd23027.png" alt="project acorn" title="project acorn" />
</p>
<h1 align="center">Project Acorn + Vue.js</h1>
<p align="center">
	<img src="https://img.shields.io/badge/version-0.1.0-green.svg" alt="Version 0.1.0" />
</p>

A theme waypoint between WordPress, its REST API and the [Project Acorn SSR](https://github.com/jomurgel/project-acorn-ssr).

## Table of Contents
  * [Use Case](#use-case)
  * [Getting Started](#getting-started)
  * [Documentation](#documentation)
  * [Recommended Add-on Plugins](#recommended-add-on-plugins)
  * [Contributing](#contributing)
  * [Changelog](#changelog)
  * [License](#license)

## Use Case
It is a SUPER bare bones theme intended ONLY to be used to give some extra functionality to our WordPress REST API waypoint and setup a few defaults and helpers along the way. This theme was built as a dev helper and not as a user-face or standard WordPress theme.  It is intended to be used along side my [Project Acorn SSR](https://github.com/jomurgel/project-acorn-ssr) or any SPA which utilizes the WordPress REST API.

## Getting Started
``` bash
$ npm install
```

``` bash
# Compile all the things
$ gulp

# Compile SVG icons
$ gulp icons

# Lints SCSS
$ gulp lint

# Minify and Optimize Admin Styles
$ gulp theme

# Compils Theme styles
$ gulp styles

# Use Browsersync and watch Styles
$ gulp watch
```

## Documentation
### Splash Page
This theme provides a splash page which is present if anyone lands on the homepage that isn't logged in or the options to redirect users to the admin login page.

Access via `Settings` > `Acorn Theme`

![screenshot 2018-04-03 12 37 23](https://user-images.githubusercontent.com/5230729/38269324-6a4703c4-373d-11e8-8eed-d1d9a930d76c.jpg)

### Custom Endpoints
I've added a few custom menu endpoints for easy access to the WordPress menus and featured images. Typically this would be wrapped into a plugin, but it was important to me that we have one item install that was ready to go.

### Featured Image
- Bakes featured image data into the REST API. forked from [BraadMartin](https://github.com/BraadMartin/better-rest-api-featured-images) with a few updates. The featured image sizes are available in the `featured_image` object inside post/page arrays.

For example:

``` json
"featured_image": {
	"id": 23,
	"alt": "",
	"caption": "",
	"description": "",
	"media_type": "image",
	"media": {
	"width": 5472,
	"height": 3648,
	"file": "2017/07/285038.jpg",
	"sizes": {
		"thumbnail": {
		"file": "285038-150x150.jpg",
		"width": 150,
		"height": 150,
		"mime-type": "image/jpeg",
		"source_url": "https://wordpress.test/server/wp-content/uploads/2017/07/285038-150x150.jpg"
		},
	},
	"image_meta": {
		"aperture": "0",
		"credit": "",
		"camera": "",
		"caption": "",
		"created_timestamp": "0",
		"copyright": "",
		"focal_length": "0",
		"iso": "0",
		"shutter_speed": "0",
		"title": "",
		"orientation": "0",
		"keywords": [

		]
	}
}
```

### Menus
It's a miss that the WordPress REST API isn't available by default. I've added a custom endpoint to fix this in `inc/menu-endpoints.php`.
- Can use `/wp-api-menus/v2/menus` for an array of menu slugs, ids and items.
- Can use `/wp-api-menus/v2/menus/id` or `wp-api-menus/v2/menus/slug` to get individual menus data.

### Default Setup
- Adds theme support for `post_thumbnail`.
- Registers WordPress menu: `Main Menu`.
- gulpfile.js with style compiling + svg icon compiling + [BrowserSync](https://www.browsersync.io/).
- custom acorn color scheme — set by default.
- Forces the standard `/%postname%/` permalink structure out of the box.

### Styles
- Style Reset with [sanitize.scss](https://jonathantneal.github.io/sanitize.css/).
- Base styles with [skeleton.scss](http://getskeleton.com/).

### Extras
This theme removes the customizer functionality, because who needs it, I mean, really? The code was forked and updated from [Customizer Remove All Parts](https://github.com/parallelus/customizer-remove-all-parts).

Acorn provides bare-bones output of page/post previews + some helper notes for those. It is not intended to function as a user-facing theme, but we must be able to preview content since the WordPress Editor is not fantastic about prepresenting the final output.

When logged in the index provides at-a-glance output of the REST API and out custom endpoints above.

![screencapture-wordpress-test-2018-04-03-12_54_13](https://user-images.githubusercontent.com/5230729/38269616-3e553e38-373e-11e8-918f-a64d2ea51016.png)

## Recommended Add-on Plugins
- [WP REST API Cache](https://wordpress.org/plugins/wp-rest-api-cache/).

## Contributing
Contributions welcome. At this moment, other than adhering to the `.eslintrc` standards, normal Github processes apply. Branch from master or fork repo and issue pull request for review. New ideas, refactoring, or additional features are always welcome.

## Changelog
Full [changelog here](https://github.com/jomurgel/project-acorn/blob/master/CHANGELOG.md).

## License
[MIT](https://opensource.org/licenses/MIT)
