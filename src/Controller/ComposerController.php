<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Entity\Category;
use App\Service\ComposerService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComposerController extends AbstractController
{
    #[Route('/composer/list/{id}', name: 'app_composer')]
    // #[Route('/Pcportable')] pour différentes routes pour la même page
    public function index(ComposerService $composerService, ManagerRegistry $doctrine, string $id): Response
    {
        $category = $doctrine->getRepository(Category::class)->find($id);
        $composers = $doctrine->getRepository(Composer::class)->findBy(['category' => $id]);

        if (!$category) {
            throw $this->createNotFoundException('No category found for id ' . $id);
        }

        return $this->render('composer/index.html.twig', [
            'category' => $category,
            'composers' => $composers,
        ]);
    }

    #[Route('/composer/{id}', name: 'app_composer_show', requirements: ['id' => '\d+'])]
    public function show(ComposerService $composerService, ManagerRegistry $doctrine, $id): Response
    {
        // Utilisez find() au lieu de findBy() pour récupérer un seul objet basé sur l'ID
        $composer = $doctrine->getRepository(Composer::class)->find($id);

        if (!$composer) {
            throw $this->createNotFoundException('No composer found for id ' . $id);
        }

        return $this->render('composer/show.html.twig', [
            'composer' => $composer,
        ]);
    }
}