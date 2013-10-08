<?php

namespace Peterjmit\BlogBundle\Controller;

use Peterjmit\BlogBundle\Doctrine\PagedPostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;

class BlogController
{
    private $repository;
    private $templating;

    public function __construct(PagedPostRepository $repository, EngineInterface $templating)
    {
        $this->repository = $repository;
        $this->templating = $templating;
    }

    public function indexAction($page = 1)
    {
        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:index.html.twig', [
            'posts' => $this->repository->findAll($page)
        ]);
    }
}
