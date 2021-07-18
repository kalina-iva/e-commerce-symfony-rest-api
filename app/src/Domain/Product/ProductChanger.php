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
        $this->setValuesToProduct($product, $sku, $name, $type, $price);
        $product->setDateCreated(new DateTime());
        $product->setDateDeleted(DateTime::createFromFormat('Y-m-d H:i:s', Product::DEFAULT_DATE_DELETED));
        $this->repository->save($product);
        return $product;
    }

    private function setValuesToProduct(Product $product, string $sku, string $name, string $type, float $price): void
    {
        $product->setName($name);
        $product->setSku($sku);
        $product->setType($type);
        $product->setPrice($price);
    }

    public function getProducts(): array
    {
        return $this->repository->getProducts();
    }

    public function markAsDeleted(Product $product): void
    {
        $product->setIsDeleted(true);
        $product->setDateDeleted(new DateTime());
        $this->repository->save($product);
    }

    public function getById(int $id): ?Product
    {
        return $this->repository->getById($id);
    }

    public function getBySku(string $sku): ?Product
    {
        return $this->repository->getBySku($sku);
    }

    public function changeProduct(Product $product, string $sku, string $name, string $type, float $price): void
    {
        $this->setValuesToProduct($product, $sku, $name, $type, $price);
        $this->repository->save($product);
    }
}
