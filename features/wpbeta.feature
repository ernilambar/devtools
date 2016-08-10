Feature: Test WordPress Beta Tester.

  Scenario: Beta tester mode
    Given a WP install

    When I run `wp dt wpbeta bleeding`
    Then STDOUT should be:
      """
      Success: Mode set to 'Bleeding edge nightlies'.
      """
    And I run `wp option get wp_beta_tester_stream`
    Then STDOUT should be:
      """
      unstable
      """

    When I run `wp dt wpbeta point`
    Then STDOUT should be:
      """
      Success: Mode set to 'Point release nightlies'.
      """
    And I run `wp option get wp_beta_tester_stream`
    Then STDOUT should be:
      """
      point
      """
