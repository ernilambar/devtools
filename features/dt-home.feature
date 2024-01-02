Feature: Test home commands.

	Background:
    Given a WP install

	Scenario: Test home with post mode
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

	Scenario: Test home in page mode with existing pages
		When I run `wp post create --post_type=page --post_status=publish --post_author=1 --post_title='Front Page' --porcelain`
		Then STDOUT should be a number
		And save STDOUT as {FRONT_PAGE_ID}

		When I run `wp post create --post_type=page --post_status=publish --post_author=1 --post_title='Blog' --porcelain`
		Then STDOUT should be a number
		And save STDOUT as {BLOG_PAGE_ID}

		When I run `wp dt home page`
		And I run `wp option list --search="page_*" --format=csv`
		Then STDOUT should contain:
			"""
			page_on_front,{FRONT_PAGE_ID}
			"""
		And STDOUT should contain:
			"""
			page_for_posts,{BLOG_PAGE_ID}
			"""
