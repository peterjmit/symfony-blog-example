Feature: Publishing blog posts

  Background:
    Given I have logged in
    And some blog posts have been written

  Scenario: Blog administrator publishes a blog post
    Given I am on "/"
    When I press "peterjmit_post_publish_1"
    Then I should be on "/"
    And I should see todays date for post 1

