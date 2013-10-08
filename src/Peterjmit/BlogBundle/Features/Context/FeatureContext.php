<?php

namespace Peterjmit\BlogBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

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
}
