<?php

namespace Peterjmit\BlogBundle\Controller;

use Peterjmit\BlogBundle\Doctrine\PostRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class BlogController
{
    private $repository;
    private $templating;

    public function __construct(PostRepository $repository, EngineInterface $templating)
    {
        $this->repository = $repository;
        $this->templating = $templating;
    }

    public function indexAction()
    {
        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:index.html.twig', [
            'posts' => $this->repository->findAll()
        ]);
    }
}
