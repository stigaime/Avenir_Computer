<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortableController extends AbstractController
{
    #[Route('/portable', name: 'app_portable')]
   //   #[Route('/Pcportable')] pour differentes routes pour la meme page
    public function index(): Response
    {
       
        $portables = ['asus', 'acer', 'msi'];

        return $this->render('portable/index.html.twig', [
            'portables' => $portables,
        ]);
  
    }
    #[Route('/portable/{id}', name: 'app_portable_show', requirements: ['id' => '\d+'])]
    public function show($id): Response
    {
        dump($id);
      return $this->render('portable/show.html.twig', [
        'id' => $id,
        'name' => 'toto',

      ]);


    }
}
