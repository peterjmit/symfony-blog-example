<?php

namespace spec\Peterjmit\BlogBundle\Twig\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogConfigurationSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $container->getParameter('peterjmit_blog.name')->willReturn('Blog name');
        $container->getParameter('peterjmit_blog.title')->willReturn('Blog title');

        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Twig\Extension\BlogConfiguration');
    }

    function it_is_a_twig_extension()
    {
        $this->shouldHaveType('\Twig_Extension');
    }

    function it_is_is_called_peterjmit_blog_configuration_extension()
    {
        $this->getName()->shouldReturn('peterjmit_blog_configuration');
    }

    function it_registers_the_blog_name_container_parameter_as_a_twig_global(ContainerInterface $container)
    {
        $this->getGlobals()->shouldHaveKey('peterjmit_blog_name');
        $this->getGlobals()->shouldHaveValue('Blog name');
    }

    function it_registers_the_blog_title_container_parameter_as_a_twig_global(ContainerInterface $container)
    {
        $this->getGlobals()->shouldHaveKey('peterjmit_blog_title');
        $this->getGlobals()->shouldHaveValue('Blog title');
    }

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value) {
                return in_array($value, $subject);
            }
        ];
    }
}
