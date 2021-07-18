<?php

declare(strict_types=1);

namespace App\Domain\Product\Repository;

use App\Domain\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function getProducts(): array;

    public function getById(int $id): ?Product;

    public function getBySku(string $sku): ?Product;
}
