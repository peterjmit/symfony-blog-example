<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Peterjmit\BlogBundle\Doctrine\PagedPostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;

class BlogControllerSpec extends ObjectBehavior
{
    function let(
        PagedPostRepository $repository,
        EngineInterface $templating
    ) {
        $this->beConstructedWith($repository, $templating);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action(
        PagedPostRepository $repository,
        EngineInterface $templating
    ) {
        $repository->findAll(1)->willReturn(['An array', 'of blog', 'posts!']);

        $templating
            ->renderResponse(
                'PeterjmitBlogBundle:Blog:index.html.twig',
                [
                    'posts' => ['An array', 'of blog', 'posts!'],
                ]
            )
            ->shouldBeCalled()
        ;

        $this->indexAction(1);
    }
}
