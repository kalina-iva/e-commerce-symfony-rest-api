<?php

declare(strict_types=1);

namespace App\Infrastructure\Product;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManager;

class ProductRepository implements ProductRepositoryInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function getProducts(): array
    {
        return $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.isDeleted = false')
            ->getQuery()
            ->getResult();
    }

    public function getById(int $id): ?Product
    {
        return $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.id = :id')
            ->andWhere('p.isDeleted = false')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getBySku(string $sku): ?Product
    {
        return $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.sku = :sku')
            ->andWhere('p.isDeleted = false')
            ->setParameter('sku', $sku)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
