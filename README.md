ernilambar/devtools
===================

[![Build Status](https://travis-ci.org/ernilambar/devtools.svg?branch=master)](https://travis-ci.org/ernilambar/devtools)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing)

## Using
This package implements the following commands:

### wp dt social
Create social menu.

~~~
wp dt social <menu-name>
~~~

**OPTIONS**

	<menu-name>
		A descriptive name for the menu.

	[--count=<number>]
		How many social icons? Default: 5

	[--porcelain]
		Output just the new menu id.

**EXAMPLES**

~~~
# Create social menu.
$ wp dt social "My Social Menu"
Success: Social menu created successfully.
~~~

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

### wp dt image
Display Image Info.

~~~
wp dt image info
~~~

**EXAMPLES**

~~~
# List registered image sizes.
$ wp dt image info
+----------------+-------+--------+------+
| id             | width | height | crop |
+----------------+-------+--------+------+
| thumbnail      | 150   | 150    | 1    |
| medium         | 300   | 300    |      |
| large          | 1024  | 1024   |      |
| post-thumbnail | 1200  | 9999   |      |
+----------------+-------+--------+------+
~~~

### wp dt widget
Widget tools

~~~
wp dt widget duplicate
~~~

Duplicate given widget instance and place it just after the widget in the sidebar.

**OPTIONS**

	<widget-id>
		Widget ID to duplicate.

**EXAMPLES**

~~~
# Duplicate text widget.
$ wp dt widget duplicate text-2
Success: Widget duplicated to 'text-3'.
~~~

~~~
wp dt widget test
~~~

Add test widgets to every sidebar.

**EXAMPLES**

~~~
# Add test widgets in each sidebar.
$ wp dt widget test
Success: Test widgets added successfully.
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
