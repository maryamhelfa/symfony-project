<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            // Electronics
            ['Wireless Headphones', 79.99, 'Premium noise cancellation headphones.', 'electronics'],
            ['Bluetooth Speaker', 59.99, 'Portable waterproof speaker.', 'electronics'],
            ['Smartphone Stand', 19.99, 'Adjustable desk stand for phones.', 'electronics'],
            ['USB-C Cable', 12.99, 'Fast charging 2m cable.', 'electronics'],

            // Fashion
            ['T-Shirt Basic', 89.00, 'Cotton t-shirt, available in multiple colors.', 'fashion'],
            ['Jean Slim', 199.00, 'Slim fit denim jeans.', 'fashion'],
            ['Sneakers Sport', 349.00, 'Comfortable running shoes.', 'fashion'],
            ['Sac à Main', 259.00, 'Elegant leather handbag.', 'fashion'],

            // Books
            ['Clean Code', 120.00, 'A handbook of agile software craftsmanship.', 'books'],
            ['Symfony 6', 95.00, 'Complete guide to Symfony framework.', 'books'],
            ['PHP 8 Pro', 110.00, 'Advanced PHP 8 programming techniques.', 'books'],
            ['Design Patterns', 130.00, 'Elements of reusable object-oriented software.', 'books'],
        ];

        foreach ($products as [$name, $price, $description, $categoryRef]) {
            $product = new Product();
            $product->setName($name);
            $product->setPrice($price);
            $product->setDescription($description);
            $product->setCategory($this->getReference($categoryRef, Category::class));
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
