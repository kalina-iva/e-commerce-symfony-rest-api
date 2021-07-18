<?php

declare(strict_types=1);

namespace App\Interfaces\Dto\Product;

use Symfony\Component\Serializer\Annotation\Groups;

class ProductIdResponseDto
{
    /**
     * @var int
     * @Groups({"get_product"})
     */
    private int $id;

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
}
