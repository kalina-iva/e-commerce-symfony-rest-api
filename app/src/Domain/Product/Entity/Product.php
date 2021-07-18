<?php

declare(strict_types=1);

namespace App\Domain\Product\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use DateTime;

/**
 * Class Product
 * @package App\Domain\Product\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="product",
 *     uniqueConstraints={
 *        @ORM\UniqueConstraint(name="sku_unique",
 *            columns={"sku","date_deleted"})
 *    })
 */
class Product
{
    public const DEFAULT_DATE_DELETED = '1000-01-01 00:00:00';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"get_product"})
     * @var int
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=64)
     * @Groups({"get_product"})
     */
    private string $sku;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_product"})
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_product"})
     */
    private string $type;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Groups({"get_product"})
     */
    private float $price;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", name="date_created")
     */
    private DateTime $dateCreated;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_deleted")
     */
    private bool $isDeleted = false;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", name="date_deleted", nullable=true)
     */
    private DateTime $dateDeleted;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return bool
     */
    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return DateTime|null
     */
    public function getDateDeleted(): ?DateTime
    {
        return $this->dateDeleted;
    }

    /**
     * @param DateTime|null $dateDeleted
     */
    public function setDateDeleted(?DateTime $dateDeleted): void
    {
        $this->dateDeleted = $dateDeleted;
    }
}
