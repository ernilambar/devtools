Feature: Test Social command.

  Scenario: Social menu
    Given a WP install

    When I run `wp dt social "My Social Menu" --porcelain`
    Then STDOUT should be:
      """
      2
      """

    When I run `wp menu list --format=csv`
    Then STDOUT should contain:
      """
      2,"My Social Menu",my-social-menu,,5
      """

    When I run `wp menu item list my-social-menu --format=csv`
    Then STDOUT should contain:
      """
      3,custom,Facebook,http://facebook.com/example,1
      4,custom,Twitter,http://twitter.com/example,2
      5,custom,Youtube,http://youtube.com/example,3
      6,custom,Linkedin,http://linkedin.com/example,4
      7,custom,Google,http://plus.google.com/example,5
      """
