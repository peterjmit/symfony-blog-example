<?php

namespace Peterjmit\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('PeterjmitBlogBundle:Blog:index.html.twig');
    }
}
