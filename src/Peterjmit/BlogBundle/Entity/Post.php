<?php

namespace Peterjmit\BlogBundle\Entity;

class Post
{
    private $id;
    private $subject;
    private $article;
    private $published;
    private $datePublished;
    private $slug;
    private $updated;

    public function __construct()
    {
        $this->published = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function isPublished()
    {
        return $this->published;
    }

    public function publish()
    {
        $this->published = true;
        $this->datePublished = new \DateTime('now');
    }

    public function getDatePublished()
    {
        return $this->datePublished;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
}
