<?php

namespace Peterjmit\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Peterjmit\BlogBundle\Doctrine\PostManager;
use Peterjmit\BlogBundle\Util\ControllerUtilities as Utils;

class PostController
{
    private $manager;
    private $utils;

    public function __construct(PostManager $manager, Utils $utils)
    {
        $this->manager = $manager;
        $this->utils = $utils;
    }

    public function newAction()
    {
        $post = $this->manager->create();
        $form = $this->utils->createForm('peterjmit_post', $post, [
            'action' => $this->utils->generateUrl('peterjmit_blog_create')
        ]);

        return $this->renderCreateForm($form);
    }

    public function createAction(Request $request)
    {
        $post = $this->manager->create();
        $form = $this->utils->createForm('peterjmit_post', $post);
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->renderCreateForm($form);
        }

        $this->manager->save($post);

        return $this->utils->redirect('blog_home');
    }

    private function renderCreateForm($form)
    {
        return $this->utils->render('PeterjmitBlogBundle:Blog:create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
