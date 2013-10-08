<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Peterjmit\BlogBundle\Doctrine\PostManager;
use Peterjmit\BlogBundle\Util\ControllerUtilities as Utils;
use Peterjmit\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;

class PostControllerSpec extends ObjectBehavior
{
    function let(PostManager $manager, Utils $utils)
    {
        $this->beConstructedWith($manager, $utils);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\PostController');
    }

    function it_creates_a_post_form_for_new_action(
        PostManager $manager,
        Utils $utils,
        FormInterface $form
    ) {
        $this->assertPostFormRendered($manager, $utils, $form);
        $utils->generateUrl('peterjmit_blog_create')->willReturn('/create');

        $this->newAction();
    }

    function it_handles_a_form_request_and_saves_the_post_and_redirects_to_home(
        PostManager $manager,
        Utils $utils,
        FormInterface $form,
        Request $request
    ) {
        $this->assertPostFormCreated($manager, $utils, $form);
        $form->isValid()->willReturn(true);

        $form->handleRequest($request)->shouldBeCalled();
        $manager->save(Argument::type('Peterjmit\BlogBundle\Entity\Post'))->shouldBeCalled();
        $utils->redirect('blog_home')->willReturn('redirect_response');

        $this->createAction($request)->shouldReturn('redirect_response');
    }

    function it_renders_the_create_form_if_the_create_form_is_invalid(
        PostManager $manager,
        Utils $utils,
        FormInterface $form,
        Request $request
    ) {
        $form->handleRequest($request)->willReturn();
        $form->isValid()->willReturn(false);

        $this->assertPostFormRendered($manager, $utils, $form);

        $this->createAction($request);
    }

    function it_publishes_a_blog_post(PostManager $manager, Post $post, Utils $utils)
    {
        $manager->publish(1)->shouldBeCalled();
        $utils->redirect('blog_home')->willReturn('/');

        $this->publishAction(1)->shouldReturn('/');
    }

    private function assertPostFormRendered(PostManager $manager, Utils $utils, FormInterface $form)
    {
        $this->assertPostFormCreated($manager, $utils, $form);

        $form->createView()->shouldBeCalled()->willReturn('form');

        $utils->render('PeterjmitBlogBundle:Blog:create.html.twig', [
            'form' => 'form'
        ])->shouldBeCalled();
    }

    private function assertPostFormCreated(PostManager $manager, Utils $utils, FormInterface $form)
    {
        $post = new Post();
        $manager->create()->willReturn($post);
        $utils->createForm('peterjmit_post', $post, Argument::any())
            ->shouldBeCalled()
            ->willReturn($form);
    }
}
