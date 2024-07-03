<?php

namespace App\Controller;

use App\Entity\Portable;
use App\Service\PortableService;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PortableController extends AbstractController
{
    #[Route('/portable', name: 'app_portable')]
   //   #[Route('/Pcportable')] pour differentes routes pour la meme page
    public function index(Environment $twig, PortableService $portableService,PaginatorInterface $paginator,Request $request, ManagerRegistry $doctrine): Response
    {
       
      
        $portables = $doctrine->getRepository(Portable::class)->findAll();

        dump($portables);
        
        //return new Response($twig->render('portable/index.html.twig', [
          //'portables' => $portables,
      //]));

      $pagination = $paginator->paginate(
        $portables, /* array of results */
        $request->query->getInt('page', 1), /* page number */
        2 /* limit per page */
    );

        return $this->render('portable/index.html.twig', [
            'portables' => $portables,
            'pagination' => $pagination,
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
