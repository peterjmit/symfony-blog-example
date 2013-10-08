<?php

namespace spec\Peterjmit\BlogBundle\Doctrine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Doctrine\Common\Persistence\ObjectManager;
use Peterjmit\BlogBundle\Entity\Post;

class PostManagerSpec extends ObjectBehavior
{
    function let(ObjectManager $om)
    {
        $this->beConstructedWith($om, 'Peterjmit\BlogBundle\Entity\Post');
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
}
