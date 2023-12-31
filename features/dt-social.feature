Feature: Test social commands.

	Scenario: Test social
		Given a WP install

		When I run `wp dt social "My Social Menu"`
		And I run `wp menu list --fields=name,slug --format=csv`
		Then STDOUT should be:
			"""
			name,slug
			"My Social Menu",my-social-menu
			"""

		When I run `wp term get nav_menu my-social-menu --by=slug --fields=name --format=json`
		Then STDOUT should be:
			"""
			{"name":"My Social Menu"}
			"""
