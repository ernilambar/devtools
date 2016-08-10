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


### wp dt wpbeta
Manage Beta Tester Mode.

~~~
wp dt wpbeta <mode>
~~~

**OPTIONS**

	<mode>
		Beta mode; `bleeding` or `point`.


## Installing

Installing this package requires WP-CLI v0.23.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with `wp package install ernilambar/devtools`.

## Contributing

Code and ideas are more than welcome.

Please [open an issue](https://github.com/ernilambar/devtools/issues) with questions, feedback, and violent dissent. Pull requests are expected to include test coverage.
