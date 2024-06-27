<?php
// src/Controller/ProfileController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route("/profile", name:"app_profil")]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérez l'utilisateur connecté
        $user = $this->getUser();

        // Récupérez tous les utilisateurs de la base de données
        $users = $userRepository->findAll();

        // Passez les données de l'utilisateur à la vue
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfileController',
            'users' => $users,
        ]);
    }

    #[Route("/profile/edit", name:"app_profil_edit")]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createNotFoundException('No user found');
        }

        $form = $this->createForm(ProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully!');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route("/profil/delete", name:"app_profil_delete")]
    public function delete(): RedirectResponse
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        // Supprimer l'utilisateur
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        session_destroy();

        // Redirection vers une page de confirmation ou une autre page
        return $this->redirectToRoute('app_home'); // Redirige vers la page d'accueil par exemple
    }
}

