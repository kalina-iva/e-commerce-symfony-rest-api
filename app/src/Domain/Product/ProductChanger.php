<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use DateTime;

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
        $product->setDateCreated(new DateTime());
        $product->setDateDeleted(DateTime::createFromFormat('Y-m-d H:i:s', Product::DEFAULT_DATE_DELETED));
        $this->repository->save($product);
        return $product;
    }

    public function getProducts(): array
    {
        return $this->repository->getProducts();
    }

    public function deleteById(int $id): void
    {
        $product = $this->repository->getById($id);
        if ($product) {
            $this->markAsDeleted($product);
        }
    }

    public function deleteBySku(string $sku): void
    {
        $product = $this->repository->getBySku($sku);
        if ($product) {
            $this->markAsDeleted($product);
        }
    }

    private function markAsDeleted(Product $product): void
    {
        $product->setIsDeleted(true);
        $product->setDateDeleted(new DateTime());
        $this->repository->save($product);
    }
}
