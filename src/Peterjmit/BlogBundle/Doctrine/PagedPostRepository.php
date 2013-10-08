<?php

namespace Peterjmit\BlogBundle\Doctrine;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class PagedPostRepository
{
    public function __construct(PostRepository $repository, $limit = 5)
    {
        $this->repository = $repository;
        $this->limit = $limit;
    }

    public function findAll($page)
    {
        $qb = $this->repository->findAllQb();

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pager->setMaxPerPage($this->limit);
        $pager->setCurrentPage($page);

        return $pager;
    }
}
