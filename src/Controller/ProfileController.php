<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

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
}



