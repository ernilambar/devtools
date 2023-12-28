ernilambar/devtools
===================

Helper tools which are commonly used in WordPress development.



Quick links: [Using](#using) | [Installing](#installing)

## Using

This package implements the following commands:

### wp dt admin

Open /wp-admin/ in a browser.

~~~
wp dt admin 
~~~





### wp dt customize

Open Customizer in a browser.

~~~
wp dt customize 
~~~





### wp dt front

Open WordPress site in a browser.

~~~
wp dt front 
~~~





### wp dt home

Front page settings.

~~~
wp dt home <mode>
~~~

**OPTIONS**

	<mode>
		Front page mode; `page` or `post`.

**EXAMPLES**

    # Set front page display to latest posts.
    $ wp dt home post
    Success: Front page displays set to Latest Posts.

    # Set front page display to static page.
    $ wp dt home page
    Success: Front page displays set to Static Page.



### wp dt social

Create a new social menu.

~~~
wp dt social <menu-name> [--count=<number>] [--porcelain]
~~~

**OPTIONS**

	<menu-name>
		A descriptive name for the menu.

	[--count=<number>]
		How many social icons?
		---
		default: 5
		---

	[--porcelain]
		Output just the new menu id.

**EXAMPLES**

    # Create social menu.
    $ wp dt social "My Social Menu"
    Success: Social menu created successfully.

## Installing

Installing this package requires WP-CLI v2.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install the latest stable version of this package with:

```bash
wp package install ernilambar/devtools:@stable
```

To install the latest development version of this package, use the following command instead:

```bash
wp package install ernilambar/devtools:dev-master
```


*This README.md is generated dynamically from the project's codebase using `wp scaffold package-readme` ([doc](https://github.com/wp-cli/scaffold-package-command#wp-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*
