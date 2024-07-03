<?php

namespace App\Controller;

use App\Repository\ComposerRepository;
use App\Repository\PortableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request): Response
    {
        // Récupérer les éléments du panier depuis la session
        $session = $request->getSession();
        $cartTotal = 0;

        // Si il y a session et items, calculer le total
        if(!is_null($session->get('cart')) && count($session->get('cart')) > 0) {
            foreach ($session->get('cart')["items"] as $item) {
                $cartTotal += (float) $item["price"] * $item["quantity"];
            }
        }

        return $this->render('cart/index.html.twig', [
            'cartItems' => $session->get('cart'),
            'cartTotal' => $cartTotal,
        ]);
    }

    #[Route('/cart/{type}/{idProduct}', name: 'app_cart_add', methods: ['POST'])]
    public function addProduct(Request $request, ComposerRepository $composerRepository, PortableRepository $portableRepository, string $type, int $idProduct): Response
    {
        // Créer la session
        $session = $request->getSession();

        // Si la session n'existe pas, la créer
        if(!$session->get('cart')) {
            $session->set('cart', [
                "items" => []
            ]);
        }

        $cart = $session->get('cart');

        // Récupérer les infos du produit en BDD selon le type et l'ajouter au panier
        if ($type === 'composer') {
            $product = $composerRepository->find($idProduct);
        } else if ($type === 'portable') {
            $product = $portableRepository->find($idProduct);
        } else {
            throw new \Exception('Type de produit inconnu');
        }

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $quantity = $request->request->getInt('quantity');
        if ($quantity <= 0 || $quantity > $product->getStock()) {
            $this->addFlash('error', 'Quantité invalide. Ce produit est disponible en ' . $product->getStock() . ' exemplaires maximum.');
            return $this->redirectToRoute('app_product_show', ['id'=> $idProduct]);
        }

        $cart["items"][] = [
            "id" => $product->getId(),
            "name" => $product->getName(),
            "description" => $product->getDescription(),
            "picture" => $product->getPicture(),
            "price" => $product->getPrice(),
            "quantity" => $quantity,
            "type" => $type,
            "priceIdStripe" => $product->getPriceIdStripe(),
        ];

        $session->set('cart', $cart);

        // Calculer le montant total du panier
        $cartTotal = 0;
        foreach ($cart["items"] as $item) {
            $cartTotal += (float) $item["price"] * $item["quantity"];
        }

        // Afficher la page panier
        return $this->render('cart/index.html.twig', [
            'cartItems' => $session->get('cart'),
            'cartTotal' => $cartTotal,
        ]);
    }

    #[Route('/cart/delete', name: 'app_cart_delete', methods: ['GET'])]
    public function deleteCart(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove('cart');

        return $this->redirectToRoute('app_cart');
    }
}
