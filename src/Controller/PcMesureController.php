<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PcMesureController extends AbstractController
{
    #[Route('/pc/mesure', name: 'app_pc_mesure')]
    public function index(): Response
    {
        return $this->render('pc_mesure/index.html.twig', [
            'controller_name' => 'PcMesureController',
        ]);
    }
}
