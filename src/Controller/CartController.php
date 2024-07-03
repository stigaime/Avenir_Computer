<?php
namespace App\Controller;

use App\Repository\ComposerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $cartTotal = 0;

        if(!is_null($session->get('cart')) && count($session->get('cart')) > 0) {
            for($i = 0; $i < count($session->get('cart')["id"]); $i++) {
                $cartTotal += (float) $session->get('cart')["price"][$i] * $session->get('cart')["stock"][$i];
            }
        }

        return $this->render('cart/index.html.twig', [
            'cartItems' => $session->get('cart'),
            'cartTotal' => $cartTotal,
        ]);
    }

    #[Route('/cart/add/{idComposer}', name: 'app_cart_add', methods: ['POST'])]
    public function addProduct(Request $request, ComposerRepository $ComposerRepository, int $idComposer): Response
    {
        $session = $request->getSession();

        if(!$session->get('cart')) {
            $session->set('cart', [
                "id" => [],
                "name" => [],
                "description" => [],
                "picture" => [],
                "price" => [],
                "stock" => [],
                "type" => [],
                "priceIdStripe" => [],
            ]);
        }

        $cart = $session->get('cart');
        $product = $ComposerRepository->find($idComposer);

        if (!$product) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }

        $cart["id"][] = $product->getId();
        $cart["name"][] = $product->getName();
        $cart["description"][] = $product->getDescription();
        $cart["picture"][] = $product->getPicture();
        $cart["price"][] = $product->getPrice();
        $cart["type"][] = $product->getType();
        $cart["priceIdStripe"][] = $product->getPriceIdStripe();
        $cart["stock"][] = 1;

        $session->set('cart', $cart);

        $cartTotal = 0;
        for($i = 0; $i < count($session->get('cart')["id"]); $i++) {
            $cartTotal += floatval($session->get('cart')["price"][$i]) * $session->get('cart')["stock"][$i];
        }

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
