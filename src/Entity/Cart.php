<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Cart
{
    private string $id;
    private \DateTime $createdAt;
    private Collection $cartItems;

    public function __construct()
    {
        $this->id = uniqid();
        $this->createdAt = new \DateTime();
        $this->cartItems = new ArrayCollection();
    }

    public function getId(): string { return $this->id; }

    public function getCartItems(): Collection { return $this->cartItems; }

    public function addCartItem(CartItem $item): void
    {
        $this->cartItems->add($item);
    }

    public function removeCartItem(CartItem $item): void
    {
        $this->cartItems->removeElement($item);
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }
}
