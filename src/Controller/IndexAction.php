<?php

namespace App\Controller;

use App\Form\SearchType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[AsController]
class IndexAction
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly Environment $twig
    ) {
    }

    #[Route('/')]
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(SearchType::class);
        //$form = $this->formFactory->createBuilder(SearchType::class)->getForm();
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