# ernilambar/devtools

WP-CLI command line tools useful for WordPress development.

Quick links: [Installing](#installing) | [Commands](#commands) | [Using](#using) | [Contributing](#contributing)

## Installing

If you have not installed WP CLI yet, please follow [WP CLI Installation](https://make.wordpress.org/cli/handbook/guides/installing/) first.

Installing this package requires WP-CLI v2.0.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with following command.

```bash
wp package install https://gitlab.com/ernilambar/devtools.git
```

If you are facing memory issue, please try following command.

```
php -d memory_limit=4000M "$(which wp)" package install https://github.com/ernilambar/devtools.git
```

## Commands

* [wp dt admin](#wp-dt-admin)
* [wp dt customize](#wp-dt-customize)
* [wp dt front](#wp-dt-front)
* [wp dt home](#wp-dt-home)
* [wp dt image](#wp-dt-image)
* [wp dt reset-theme-mod](#wp-dt-reset-theme-mod)
* [wp dt social](#wp-dt-social)
* [wp dt widget](#wp-dt-widget)

## Using
This package implements the following commands:

### wp dt admin
Open WordPress admin panel in the browser.

~~~
wp dt admin
~~~

### wp dt customize
Open WordPress Customizer in the browser.

~~~
wp dt customize
~~~

### wp dt front
Open WordPress front-end in the browser.

~~~
wp dt front
~~~

### wp dt home
Manage Front Page Settings.

~~~
wp dt home <mode>
~~~

**OPTIONS**

~~~
<mode>
  Front page mode; `page` or `post`.
~~~

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

### wp dt reset-theme-mod
Reset theme mod of currently active theme.

~~~
wp dt reset-theme-mod
~~~

### wp dt social
Create social menu.

~~~
wp dt social <menu-name>
~~~

**OPTIONS**

~~~
<menu-name>
  A descriptive name for the menu.

[--count=<number>]
  How many social icons? Default: 5

[--porcelain]
  Output just the new menu id.
~~~

**EXAMPLES**

~~~
# Create social menu.
$ wp dt social "My Social Menu"
Success: Social menu created successfully.
~~~

### wp dt widget
Widget tools.

#### wp dt widget duplicate

~~~
wp dt widget duplicate
~~~

Duplicate given widget instance and place it just after the widget in the sidebar.

**OPTIONS**

~~~
<widget-id>
  Widget ID to duplicate.
~~~

**EXAMPLES**

~~~
# Duplicate text widget.
$ wp dt widget duplicate text-2
Success: Widget duplicated to 'text-3'.
~~~

#### wp dt widget test

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

## Contributing

Code and ideas are more than welcome. Please [open an issue](https://github.com/ernilambar/devtools/issues).
