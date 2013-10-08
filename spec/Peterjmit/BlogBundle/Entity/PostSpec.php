<?php

namespace spec\Peterjmit\BlogBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Entity\Post');
    }

    function it_has_a_subject()
    {
        $this->setSubject('Subject');
        $this->getSubject()->shouldReturn('Subject');
    }

    function it_has_an_article()
    {
        $this->setArticle('Article');
        $this->getArticle()->shouldReturn('Article');
    }

    function it_is_not_published_by_default()
    {
        $this->shouldNotBePublished();
    }

    function it_can_be_published()
    {
        $this->publish();
        $this->shouldBePublished();
    }

    function it_should_set_the_date_it_was_published()
    {
        $this->publish();
        $this->getDatePublished()->shouldReturnAnInstanceOf('DateTime');
    }
}
