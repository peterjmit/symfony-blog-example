Feature: Blog configuration

  Background:
    Given I have logged in

  Scenario: Developer can configure blog name and title
    # Parameters configured in config_test.yml
    When I go to "/"
    Then I should see "Test name"
    And I should see "Test blog title"
