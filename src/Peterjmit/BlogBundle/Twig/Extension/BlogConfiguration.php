<?php

namespace Peterjmit\BlogBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogConfiguration extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'peterjmit_blog_configuration';
    }

    public function getGlobals()
    {
        return [
            'peterjmit_blog_name' => $this->container->getParameter('peterjmit_blog.name'),
            'peterjmit_blog_title' => $this->container->getParameter('peterjmit_blog.title'),
        ];
    }
}
