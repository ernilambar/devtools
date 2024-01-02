Feature: Test home commands.

	Scenario: Test home with post mode
		Given a WP install

		When I run `wp dt home post`
		Then STDOUT should be:
			"""
			Success: Homepage displays set to Latest Posts.
			"""

		When I run `wp option get show_on_front`
		Then STDOUT should be:
			"""
			posts
			"""

		When I run `wp option get page_on_front`
		Then STDOUT should be:
			"""
			0
			"""

		When I run `wp option get page_for_posts`
		Then STDOUT should be:
			"""
			0
			"""

	Scenario: Test home with page mode
		Given a WP install

		When I run `wp dt home page`
		Then STDOUT should be:
			"""
			Success: Homepage displays set to Static Page.
			"""

		When I run `wp option get show_on_front`
		Then STDOUT should be:
			"""
			page
			"""

		When I run `wp option get page_on_front`
		Then STDOUT should be a number

		When I run `wp option get page_for_posts`
		Then STDOUT should be a number

		When I run `wp post list --post_type=page --fields=post_name --format=csv`
		Then STDOUT should contain:
			"""
			blog
			"""
		And STDOUT should contain:
			"""
			front-page
			"""
