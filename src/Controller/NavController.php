<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/nav', name: 'app_nav')]
    public function index(ManagerRegistry $doctrine): Response {


        $categories = $doctrine->getRepository(Category::class)->findAll();

        return $this->render('nav.html.twig', [
            'categories' => $categories,
        ]);
    }
}
