<?php

namespace Peterjmit\BlogBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

use Behat\Symfony2Extension\Context\KernelDictionary;
use Behat\MinkExtension\Context\MinkDictionary;

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
}
