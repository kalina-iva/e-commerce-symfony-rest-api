<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\ProductChanger;

class ProductService
{
    private ProductChanger $productChanger;

    public function __construct(ProductChanger $productChanger)
    {
        $this->productChanger = $productChanger;
    }

    public function getProducts(): array
    {
        return $this->productChanger->getProducts();
    }

    public function createProduct(string $sku, string $name, string $type, float $price): Product
    {
        return $this->productChanger->createProduct($sku, $name, $type, $price);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productChanger->markAsDeleted($product);
    }

    public function getById(int $id): ?Product
    {
        return $this->productChanger->getById($id);
    }

    public function getBySku(string $sku): ?Product
    {
        return $this->productChanger->getBySku($sku);
    }
}
