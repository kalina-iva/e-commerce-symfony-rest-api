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

    public function getProduct(): array
    {
        return ['hi' => 'ok'];
    }

    public function createProduct(string $sku, string $name, string $type, float $price): Product
    {
        return $this->productChanger->createProduct($sku, $name, $type, $price);
    }
}
