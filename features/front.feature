Feature: Test Front Page Settings.

  Background:
    Given a WP install

    When I run `wp theme install twentytwelve --activate`
    Then STDOUT should not be empty


  Scenario: Post as Front Page Settings
    When I run `wp dt front post`
    Then STDOUT should be:
      """
      Success: Front page displays set to Latest Posts.
      """
    And I run `wp option get show_on_front`
    Then STDOUT should be:
      """
      posts
      """
    And I run `wp option get page_on_front`
    Then STDOUT should be:
      """
      0
      """
    And I run `wp option get page_for_posts`
    Then STDOUT should be:
      """
      0
      """

  Scenario: Page as Front Page Settings
    When I run `wp dt front page`
    Then STDOUT should be:
      """
      Success: Front page displays set to Static Page.
      """
    And I run `wp option get show_on_front`
    Then STDOUT should be:
      """
      page
      """
    And I run `wp option get page_on_front`
    Then STDOUT should be:
      """
      3
      """
    And I run `wp option get page_for_posts`
    Then STDOUT should be:
      """
      4
      """
