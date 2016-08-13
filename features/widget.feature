Feature: Test Widget commands.

  Scenario: Widget test
    Given a WP install

    When I run `wp theme install twentysixteen --activate`
    And I run `wp widget reset --all`
    Then STDOUT should not be empty

    When I run `wp dt widget test`
    Then STDOUT should be:
      """
      Success: Test widgets added successfully.
      """

    When I run `wp widget list sidebar-1 --format=count`
    Then STDOUT should be:
      """
      1
      """

    When I run `wp widget list sidebar-1 --format=json`
    Then STDOUT should be:
      """
      [{"name":"text","id":"text-1","position":1,"options":{"title":"Sidebar: sidebar-1","text":"This is 'sidebar-1' sidebar.","filter":false}}]
      """

    When I run `wp dt widget test`
    Then STDOUT should be:
      """
      Success: Test widgets added successfully.
      """

    When I run `wp widget list sidebar-1 --format=count`
    Then STDOUT should be:
      """
      2
      """

    When I run `wp widget list sidebar-1 --format=csv`
    Then STDOUT should be:
      """
      name,id,position,options
      text,text-4,1,"{""title"":""Sidebar: sidebar-1"",""text"":""This is 'sidebar-1' sidebar."",""filter"":false}"
      text,text-1,2,"{""title"":""Sidebar: sidebar-1"",""text"":""This is 'sidebar-1' sidebar."",""filter"":false}"
      """
