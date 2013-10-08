<?php

namespace Peterjmit\BlogBundle\Util;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class ControllerUtilities
{
    public function __construct(
        Router $router,
        EngineInterface $templating,
        FormFactory $formFactory
    ) {
        $this->router = $router;
        $this->templating = $templating;
        $this->formFactory = $formFactory;
    }

    public function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }

    public function redirect($route, $parameters = [], $code = 302)
    {
        return new RedirectResponse(
            $this->generateUrl($route, $parameters),
            $code
        );
    }

    public function render($template, $parameters = [], Response $response = null)
    {
        return $this->templating->renderResponse($template, $parameters, $response);
    }

    public function createForm($type, $data = null, array $options = [])
    {
        return $this->formFactory->create($type, $data, $options);
    }

}
