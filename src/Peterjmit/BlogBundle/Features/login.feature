Feature: login

  Scenario: Blog administrator logs in
    When I go to "/login"
    And I fill in "username" with "admin"
    And I fill in "password" with "mypass"
    And I press "login"
    Then I should be on "/"
    And the response status code should be 200
