<?php

namespace spec\Peterjmit\BlogBundle\Doctrine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Doctrine\ORM\QueryBuilder;
use Peterjmit\BlogBundle\Doctrine\PostRepository;

class PagedPostRepositorySpec extends ObjectBehavior
{
    function let(PostRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Doctrine\PagedPostRepository');
    }

    function it_finds_all_and_returns_a_pagerfanta_instance(
        PostRepository $repository,
        QueryBuilder $qb
    ) {
        $repository->findAllQb()->willReturn($qb);

        $this->findAll(1)->shouldReturnAnInstanceOf('Pagerfanta\Pagerfanta');
    }
}
