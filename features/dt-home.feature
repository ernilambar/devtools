Feature: Test home commands.

	Scenario: Test home
		Given a WP install

		When I run `wp dt home post`
		Then STDOUT should be:
			"""
			Success: Front page displays set to Latest Posts.
			"""

		When I run `wp dt home page`
		Then STDOUT should be:
			"""
			Success: Front page displays set to Static Page.
			"""
