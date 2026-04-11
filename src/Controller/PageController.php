<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('pages/index.html.twig');
    }

    #[Route('/categories', name: 'categories')]
    public function categories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('pages/browse_categories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/products-category/{id}', name: 'products_by_category')]
    public function productsByCategory(
        int $id,
        ProductRepository $productRepository
    ): Response {
        $products = $productRepository->findBy(['category' => $id]);
        return $this->render('pages/products_by_category.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/{id}', name: 'product_details')]
    public function productDetails(
        int $id,
        ProductRepository $productRepository
    ): Response {
        $product = $productRepository->find($id);
        return $this->render('pages/product_details.html.twig', [
            'product' => $product
        ]);
    }
}
