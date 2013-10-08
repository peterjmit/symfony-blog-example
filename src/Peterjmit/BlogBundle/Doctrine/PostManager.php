<?php

namespace Peterjmit\BlogBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Peterjmit\BlogBundle\Entity\Post;

class PostManager
{
    private $om;
    private $className;

    public function __construct(ObjectManager $om, $className)
    {
        $this->om = $om;
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
}
