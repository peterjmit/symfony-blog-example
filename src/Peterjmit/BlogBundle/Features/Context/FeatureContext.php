<?php

namespace Peterjmit\BlogBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
use Behat\Mink\Exception\ExpectationException;

use Behat\Symfony2Extension\Context\KernelDictionary;
use Behat\MinkExtension\Context\MinkDictionary;
use Behat\Behat\Context\Step;

use Nelmio\Alice\Fixtures;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

/**
 * Feature context.
 */
class FeatureContext extends BehatContext
{
    use KernelDictionary;
    use MinkDictionary;

    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @Then /^I should see todays date for post (\d+)$/
     */
    public function iShouldSeeTodaysDateForPost($postId)
    {
        $expectedDate = (new \DateTime('now'))->format('F jS, Y');

        $article = $this->findPostArticleNode($postId);
        $time = $article->find('css', 'time');

        if ($time && $time->getText() === $expectedDate) {
            return;
        }

        throw new ExpectationException(sprintf(
            'Expected article #%s to have published date %s',
            $postId,
            $expectedDate
        ), $this->getSession());
    }

    /**
     * @Given /^I have logged in$/
     */
    public function iHaveLoggedIn()
    {
        return [
            new Step\When('I am on "login"'),
            new Step\When('I fill in "username" with "admin"'),
            new Step\When('I fill in "password" with "mypass"'),
            new Step\When('I press "login"'),
            new Step\Then('I should be on "/"'),
        ];
    }

    /**
     * @Given /^some blog posts have been written$/
     */
    public function someBlogPostsHaveBeenWritten()
    {
        $manager = $this->getContainer()->get('doctrine')->getManager();
        $purger = new ORMPurger($manager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        $executor = new ORMExecutor($manager, $purger);
        $executor->purge();

        Fixtures::load(__DIR__ . '/../fixtures.yml', $manager);

        $manager->clear();
    }

    private function findPostArticleNode($id)
    {
        $page = $this->getSession()->getPage();
        $article = $page->findById(sprintf('peterjmit_post_%s', $id));

        if (!$article) {
            throw new ExpectationException(sprintf('Could not find article for post #%s', $id), $this->getSession());
        }

        return $article;
    }
}
