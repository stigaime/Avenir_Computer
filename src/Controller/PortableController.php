<?php

namespace App\Controller;

use App\Entity\Portable;
use App\Service\PortableService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PortableController extends AbstractController
{
    #[Route('/portable', name: 'app_portable')]
   //   #[Route('/Pcportable')] pour differentes routes pour la meme page
    public function index(Environment $twig, PortableService $portableService, ManagerRegistry $doctrine): Response
    {
       
      
        $portables = $doctrine->getRepository(Portable::class)->findAll();

        dump($portables);
        
        //return new Response($twig->render('portable/index.html.twig', [
          //'portables' => $portables,
      //]));

        return $this->render('portable/index.html.twig', [
            'portables' => $portables,
        ]);
  
    }
    #[Route('/portable/{id}', name: 'app_portable_show', requirements: ['id' => '\d+'])]
    public function show( PortableService $portableService, ManagerRegistry $doctrine, $id): Response
    {
          //$portable = $portableService->find($id);
          $portable = $doctrine->getRepository(Portable::class)->find($id);

        dump($portable);

          if (! $portable) {
              throw $this->createNotFoundException();
          }

      return $this->render('portable/show.html.twig', [
       
        'portable' => $portable,

      ]);


    }
}
