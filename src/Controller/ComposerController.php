<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Service\ComposerService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ComposerController extends AbstractController
{
    #[Route('/composer', name: 'app_composer')]
   //   #[Route('/Pcportable')] pour differentes routes pour la meme page
    public function index(Environment $twig, ComposerService $composerService, ManagerRegistry $doctrine): Response
    {
       
      
        $composers = $doctrine->getRepository(Composer::class)->findAll();

        dump($composers);
        
        //return new Response($twig->render('composer/index.html.twig', [
          //'portables' => $portables,
      //]));

        return $this->render('composer/index.html.twig', [
            'composers' => $composers,
        ]);
  
    }
    #[Route('/composer/{id}', name: 'app_composer_show', requirements: ['id' => '\d+'])]
    public function show( ComposerService $composerService, ManagerRegistry $doctrine, $id): Response
    {
          //$portable = $portableService->find($id);
          $composer = $doctrine->getRepository(Composer::class)->find($id);

        dump($composer);

          if (! $composer) {
              throw $this->createNotFoundException();
          }

      return $this->render('composer/show.html.twig', [
       
        'composer' => $composer,

      ]);


    }
}
