Feature: Test home commands.

	Scenario: Test home
		Given a WP install

		When I run `wp dt home post`
		Then STDOUT should be:
			"""
			Success: Homepage displays set to Latest Posts.
			"""

		When I run `wp dt home page`
		Then STDOUT should be:
			"""
			Success: Homepage displays set to Static Page.
			"""

    When I run `wp dt home page`
		And I run `wp post list --post_type=page --fields=post_name --format=csv`
		Then STDOUT should contain:
			"""
			blog
			"""
		And STDOUT should contain:
			"""
			front-page
			"""
