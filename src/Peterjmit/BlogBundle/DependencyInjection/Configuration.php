<?php

namespace Peterjmit\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('peterjmit_blog');

        $rootNode
            ->children()
                ->scalarNode('name')
                    ->defaultValue('Apple blog')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('title')
                    ->defaultValue('Welcome to the Apple Blog!')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
