<?php

declare(strict_types=1);

namespace App\Infrastructure\Product;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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

        try {
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $exception) {
            throw new BadRequestException('Product with such sku already exists');
        }
    }

    public function getProducts(int $page, int $limit): array
    {
        return $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.isDeleted = false')
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit)
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
