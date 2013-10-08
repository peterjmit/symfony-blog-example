<?php

namespace spec\Peterjmit\BlogBundle\Doctrine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Doctrine\Common\Persistence\ObjectManager;
use Peterjmit\BlogBundle\Doctrine\PostRepository;
use Peterjmit\BlogBundle\Entity\Post;

class PostManagerSpec extends ObjectBehavior
{
    function let(ObjectManager $om, PostRepository $repository)
    {
        $this->beConstructedWith($om, $repository, 'Peterjmit\BlogBundle\Entity\Post');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Doctrine\PostManager');
    }

    function it_creates_a_post()
    {
        $this->create()->shouldReturnAnInstanceOf('Peterjmit\BlogBundle\Entity\Post');
    }

    function it_saves_a_post(ObjectManager $om, Post $post)
    {
        $om->persist($post)->shouldBeCalled();
        $om->flush()->shouldBeCalled();

        $this->save($post);
    }

    function it_publishes_a_post(ObjectManager $om, PostRepository $repository, Post $post)
    {
        $repository->find(1)->willReturn($post);
        $post->publish()->shouldBeCalled();
        $om->persist($post)->shouldBeCalled();
        $om->flush()->shouldBeCalled();

        $this->publish(1);
    }

    function it_thows_an_InvalidArgumentException_if_publishing_an_unrecognized_post(PostRepository $repository)
    {
        $repository->find(999)->willReturn(null);

        $this->shouldThrow('\InvalidArgumentException')
            ->duringPublish(999);
    }
}
