<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Peterjmit\BlogBundle\Doctrine\PostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class BlogControllerSpec extends ObjectBehavior
{
    function let(
        PostRepository $repository,
        EngineInterface $templating
    ) {
        $this->beConstructedWith($repository, $templating);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action(
        PostRepository $repository,
        EngineInterface $templating
    ) {
        $repository->findAll()->willReturn(['An array', 'of blog', 'posts!']);

        $templating
            ->renderResponse(
                'PeterjmitBlogBundle:Blog:index.html.twig',
                ['posts' => ['An array', 'of blog', 'posts!']]
            )
            ->shouldBeCalled()
        ;

        $this->indexAction();
    }
}
