<?php

namespace Peterjmit\BlogBundle\Entity;

class Post
{
    private $subject;
    private $article;
    private $published;
    private $datePublished;

    public function __construct()
    {
        $this->published = false;
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
}
