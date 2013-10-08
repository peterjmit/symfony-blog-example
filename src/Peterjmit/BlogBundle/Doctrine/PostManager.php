<?php

namespace Peterjmit\BlogBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Peterjmit\BlogBundle\Entity\Post;

class PostManager
{
    private $om;
    private $className;
    private $repository;

    public function __construct(ObjectManager $om, PostRepository $repository, $className)
    {
        $this->om = $om;
        $this->repository = $repository;
        $this->className = $className;
    }

    public function create()
    {
        return new $this->className;
    }

    public function save(Post $post, $flush = true)
    {
        $this->om->persist($post);

        if ($flush === true) {
            $this->om->flush();
        }
    }

    public function publish($id)
    {
        $post = $this->repository->find($id);

        if (!$post) {
            throw new \InvalidArgumentException(sprintf('Post #%s not found', $id));
        }

        $post->publish();
        $this->save($post);
    }
}
