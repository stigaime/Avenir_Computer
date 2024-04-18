<?php

namespace App\Controller;

use App\Service\PortableService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PortableController extends AbstractController
{
    #[Route('/portable', name: 'app_portable')]
   //   #[Route('/Pcportable')] pour differentes routes pour la meme page
    public function index(Environment $twig, PortableService $portableService): Response
    {
       
      
        $portables = $portableService->all();

        //dump($portableService);
        
        //return new Response($twig->render('portable/index.html.twig', [
          //'portables' => $portables,
      //]));

        return $this->render('portable/index.html.twig', [
            'portables' => $portables,
        ]);
  
    }
    #[Route('/portable/{id}', name: 'app_portable_show', requirements: ['id' => '\d+'])]
    public function show( PortableService $portableService, $id): Response
    {
          $portable = $portableService->find($id);

        dump($portable);
      return $this->render('portable/show.html.twig', [
        'id' => $id,
        'name' => 'toto',

      ]);


    }
}
