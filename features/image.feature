Feature: Test Image commands.

  Scenario: Image info
    Given a WP install

    When I run `wp theme install p2 --activate`
    Then STDOUT should not be empty

    When I run `wp dt image info --format=csv`
    Then STDOUT should be:
      """
      id,width,height,crop
      thumbnail,150,150,1
      medium,300,300,
      large,1024,1024,
      """
