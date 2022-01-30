ernilambar/devtools
===================

Quick links: [Installing](#installing) | [Using](#using) | [Contributing](#contributing)

## Installing

Installing this package requires WP-CLI v0.23.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with following command.

```bash
wp package install https://gitlab.com/ernilambar/devtools.git
```

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

### wp dt home
Manage Front Page Settings.

~~~
wp dt home <mode>
~~~

**OPTIONS**

	<mode>
		Front page mode; `page` or `post`.

**EXAMPLES**

~~~
# Set front page display to static page.
$ wp dt home page
Success: Front page displays set to Static Page.

# Set front page display to latest posts.
$ wp dt home post
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
| thumbnail      | 150   | 150    | hard |
| medium         | 300   | 300    | soft |
| large          | 1024  | 1024   | soft |
| post-thumbnail | 1200  | 9999   | soft |
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

### wp dt admin
Open WordPress admin panel in the browser.

~~~
wp dt admin
~~~

### wp dt front
Open WordPress front-end in the browser.

~~~
wp dt front
~~~

### wp dt customize
Open WordPress Customizer in the browser.

~~~
wp dt customize
~~~

## Contributing

Code and ideas are more than welcome. Please [open an issue](https://github.com/ernilambar/devtools/issues).
