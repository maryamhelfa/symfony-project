<?php

namespace App\Handler;

use App\Cart\CartInterface;
use App\Entity\Cart;
use App\Entity\CartItem;

class CartHandler
{
    public function handle(Cart $cart, CartItem $item, CartInterface $strategy): Cart
    {
        return $strategy->add($item, $cart);
    }
}
