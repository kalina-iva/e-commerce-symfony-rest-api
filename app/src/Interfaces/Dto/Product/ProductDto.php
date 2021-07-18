<?php

declare(strict_types=1);

namespace App\Interfaces\Dto\Product;

use Symfony\Component\Validator\Constraints as Assert;

class ProductDto
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max=64)
     * @Assert\Regex(
     *     pattern = "/^\S+$/",
     *     message="sku cannot contain spaces"
     * )
     */
    private string $sku;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private string $name;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Choice({"game", "GAME", "currency", "CURRENCY"})
     */
    private string $type;

    /**
     * @var float
     * @Assert\Type("float")
     * @Assert\NotBlank()
     * @Assert\PositiveOrZero
     * @Assert\LessThan(
     *     value = 9999999999
     * )
     */
    private float $price;

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
        return strtoupper($this->type);
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
}
