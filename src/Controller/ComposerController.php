<?php
/// src/Controller/ComposerController.php
namespace App\Controller;

use App\Entity\Composer;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComposerController extends AbstractController
{
    #[Route('/composer/list/{id}', name: 'app_composer')]
    public function index(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request, string $id): Response
    {
        $category = $doctrine->getRepository(Category::class)->find($id);

        if (!$category) {
            throw $this->createNotFoundException('No category found for id ' . $id);
        }

        // Utiliser findBy pour obtenir les résultats
        $composers = $doctrine->getRepository(Composer::class)->findBy(['category' => $id]);

        // Paginer les résultats
        $pagination = $paginator->paginate(
            $composers, /* array of results */
            $request->query->getInt('page', 1), /* page number */
            2 /* limit per page */
        );

        return $this->render('composer/index.html.twig', [
            'category' => $category,
            'pagination' => $pagination,
        ]);
    }





    
    #[Route('/composer/{id}', name: 'app_composer_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, string $id): Response
    {
        $composer = $doctrine->getRepository(Composer::class)->find($id);

        if (!$composer) {
            throw $this->createNotFoundException('No composer found for id ' . $id);
        }

        return $this->render('composer/show.html.twig', [
            'composer' => $composer,
        ]);
    }
}
