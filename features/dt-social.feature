Feature: Test social commands.

	Scenario: Test social
		Given a WP install

		When I run `wp dt social "My Social Menu"`
		Then STDOUT should contain:
			"""
			Success: Social menu created successfully.
			"""
