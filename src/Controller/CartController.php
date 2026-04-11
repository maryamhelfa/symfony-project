<?php

namespace App\Controller;

use App\Cart\CartInterface;
use App\Entity\CartItem;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(service: 'App\Cart\SessionCart')]
        private CartInterface $cartService
    ) {}

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);
        $cart = $this->cartService->getCart('main_cart');
        $item = new CartItem($product, 1);
        $this->cartService->add($item, $cart);

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/cart', name: 'cart_show')]
    public function show(): Response
    {
        $cart = $this->cartService->getCart('main_cart');
        return $this->render('pages/cart.html.twig', [
            'cart' => $cart
        ]);
    }
}
