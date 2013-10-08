Feature: Reading blog posts

  Background:
    Given I have logged in
    And some blog posts have been written

  Scenario: Blog administrator reads a list of blog posts
    When I am on "/"
    Then I should see "Awesome blog post 1"
    And I should see "How-to: write a blog app for apple"

