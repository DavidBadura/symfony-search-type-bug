<?php

namespace App\Controller;

use App\Form\OtherNameType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[AsController]
class OtherAction
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly Environment $twig
    ) {
    }

    #[Route('/other')]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(OtherNameType::class);
        //$form = $this->formFactory->createBuilder(OtherNameType::class)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return new Response(
            $this->twig->render('index.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}