ernilambar/devtools
===================



[![Build Status](https://travis-ci.org/ernilambar/devtools.svg?branch=master)](https://travis-ci.org/ernilambar/devtools)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing)

## Using
This package implements the following commands:

### wp dt front
Manage Front Page Settings.

~~~
wp dt front <mode>
~~~

**OPTIONS**

	<mode>
		Front page mode; `page` or `post`.

**EXAMPLES**

~~~
# Set front page display to static page.
$ wp dt front page
Success: Front page displays set to Static Page.

# Set front page display to latest posts.
$ wp dt front post
Success: Front page displays set to Latest Posts.
~~~

### wp dt wpbeta
Manage Beta Tester Mode. Requires `WordPress Beta Tester` plugin.

~~~
wp dt wpbeta <mode>
~~~

**OPTIONS**

	<mode>
		Beta mode; `bleeding` or `point`.

**EXAMPLES**

~~~
# Set mode to bleeding edge.
$ wp dt wpbeta bleeding
Success: Mode set to 'Bleeding edge nightlies'.

# Set mode to point release.
$ wp dt wpbeta point
Success: Mode set to 'Point release nightlies'.
~~~

## Installing

Installing this package requires WP-CLI v0.23.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with `wp package install ernilambar/devtools`.

## Contributing

Code and ideas are more than welcome.

Please [open an issue](https://github.com/ernilambar/devtools/issues) with questions, feedback, and violent dissent. Pull requests are expected to include test coverage.
