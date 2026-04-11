<?php

namespace App\Cart;

use App\Entity\Cart;
use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    public function __construct(private RequestStack $requestStack) {}

    private function getSession()
    {
        return $this->requestStack->getSession();
    }

    public function getCart(string $identifier): Cart
    {
        $session = $this->getSession();
        $cart = $session->get($identifier);
        if (!$cart) {
            $cart = new Cart();
            $session->set($identifier, $cart);
        }
        return $cart;
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        $session = $this->getSession();
        $cart->addCartItem($item);
        $session->set($cart->getId(), $cart);
        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $session = $this->getSession();
        $cart->removeCartItem($item);
        $session->set($cart->getId(), $cart);
        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->getSession()->remove($identifier);
    }
}
