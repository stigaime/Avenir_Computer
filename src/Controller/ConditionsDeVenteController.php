<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionsDeVenteController extends AbstractController
{
    #[Route('/conditions/de/vente', name: 'app_vente')]
    public function index(): Response
    {
        return $this->render('conditions_de_vente/index.html.twig', [
            'controller_name' => 'ConditionsDeVenteController',
        ]);
    }
}
