<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            'electronics' => 'Electronics',
            'fashion'     => 'Fashion',
            'books'       => 'Books',
        ];

        foreach ($categories as $ref => $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference($ref, $category);
        }

        $manager->flush();
    }
}
