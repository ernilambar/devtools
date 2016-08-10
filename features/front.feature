Feature: Test Front Page Settings.
  Given a WP install

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
