Feature: Test WordPress Beta Tester.

  Scenario: Beta tester mode
    Given a WP install

    When I run `wp dt wpbeta bleeding`
    Then STDOUT should be:
      """
      Success: Mode set to 'Bleeding edge nightlies'.
      """
