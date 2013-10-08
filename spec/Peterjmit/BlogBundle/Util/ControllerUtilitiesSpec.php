<?php

namespace spec\Peterjmit\BlogBundle\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Router;

class ControllerUtilitiesSpec extends ObjectBehavior
{
    function let(Router $router, EngineInterface $templating, FormFactory $formFactory)
    {
        $this->beConstructedWith($router, $templating, $formFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Util\ControllerUtilities');
    }

    function it_generates_a_url(Router $router)
    {
        $router->generate('named_route', [], Argument::any())
            ->willReturn('/');

        $this->generateUrl('named_route')->shouldReturn('/');
    }

    function it_returns_a_redirect_response(Router $router)
    {
        $router
            ->generate('named_route', [], Argument::any())
            ->willReturn('/')
            ->shouldBeCalled()
        ;

        $this->redirect('named_route')
            ->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\RedirectResponse');
    }

    function it_renders_a_template_response(EngineInterface $templating)
    {
        $templating->renderResponse('template', [], null)->shouldBeCalled()->willReturn('template_response');

        $this->render('template')->shouldReturn('template_response');
    }

    function it_creates_a_form(FormFactory $formFactory)
    {
        $formFactory->create('type', ['data'], [])->shouldBeCalled()->willReturn('form');

        $this->createForm('type', ['data'])->shouldReturn('form');
    }
}
