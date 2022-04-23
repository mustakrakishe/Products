<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocaleProductController extends AbstractController
{
    #[Route(
        '/api/{localeIso}/products',
        name: 'api_locale_products_get_collection',
        methods: ['GET']
    )]
    public function index(ManagerRegistry $doctrine, string $localeIso): Response
    {
        return $this->json(
            $doctrine
                ->getRepository(Product::class)
                ->findByLocaleIso($localeIso)
        );
    }
    
    #[Route(
        '/api/{localeIso}/products/{productId}',
        name: 'api_locale_products_get_item',
        methods: ['GET']
    )]
    public function show(ManagerRegistry $doctrine, string $localeIso, int $productId): Response
    {
        return $this->json(
            $doctrine
                ->getRepository(Product::class)
                ->findOneByIdAndLocaleIso($productId, $localeIso)
        );
    }
}
