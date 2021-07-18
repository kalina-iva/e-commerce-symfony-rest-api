<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class ProductChanger
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createProduct(string $sku, string $name, string $type, float $price): Product
    {
        $product = new Product();
        $product->setName($name);
        $product->setSku($sku);
        $product->setType($type);
        $product->setPrice($price);
        $this->repository->save($product);
        return $product;
    }
}
