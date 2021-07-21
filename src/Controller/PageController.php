<?php

namespace App\Controller;

use App\Service\MeiliSearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig');
    }

    #[Route('/reset', name: 'app_reset')]
    public function reset(MeiliSearchService $meiliSearchService): Response
    {
        $meiliSearchService->deleteAllIndexes();

        return $this->render('page/index.html.twig');
    }
}
