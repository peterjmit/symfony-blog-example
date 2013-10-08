Feature: Creating blog posts

  Background:
    Given I have logged in

  Scenario: Blog administrator can create a blog post
    Given I am on "/"
    When I follow "Create post"
    Then I should be on "/new"
    And the response status code should be 200

  Scenario: Blog administrator creates a blog post
    When I am on "/new"
    And I fill in "peterjmit_post_subject" with "New subject!"
    And I fill in "peterjmit_post_article" with "Article body"
    And I press "peterjmit_post_submit"
    Then I should be on "/"
    And I should see "New subject!"

  Scenario: Error message is shown if creating blog post without subject
    When I am on "/new"
    And I fill in "article" with "Article body"
    And I press "submit"
    Then I should see "please give your post a subject!"

  Scenario: Error message is show if creating post without article
    When I am on "/new"
    And I fill in "subject" with "New subject!"
    And I press "submit"
    Then I should see "please give your post an article!"
