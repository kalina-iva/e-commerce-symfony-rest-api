<?php

declare(strict_types=1);

namespace App\Interfaces\Http\Controller;

use App\Application\ProductService;
use App\Domain\Product\Entity\Product;
use App\Interfaces\Dto\Product\CreateProductDto;
use App\Interfaces\Dto\Product\ProductIdResponseDto;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Rest\Route("/v1/product")
 */
class ProductController extends AbstractFOSRestController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Rest\Get("/all")
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->productService->getProducts();
    }

    /**
     * @Rest\Post("")
     * @ParamConverter("dto", converter="fos_rest.request_body")
     * @Rest\View(statusCode=201, serializerGroups={"get_product"})
     *
     * @param CreateProductDto $dto
     * @param ConstraintViolationListInterface $validationErrors
     * @return ProductIdResponseDto
     */
    public function createProduct(
        CreateProductDto $dto,
        ConstraintViolationListInterface $validationErrors
    ): ProductIdResponseDto {
        if (count($validationErrors) > 0) {

        }
        $product = $this->productService->createProduct(
            $dto->getSku(),
            $dto->getName(),
            $dto->getType(),
            $dto->getPrice()
        );
        $responseDto = new ProductIdResponseDto();
        $responseDto->setId($product->getId());
        return $responseDto;
    }

    /**
     * @Rest\Delete("/{id}", requirements={"id"="\d+"}))
     * @Rest\View(statusCode=204)
     *
     * @param int $id
     */
    public function deleteProductById(int $id): void
    {
        $this->productService->deleteById($id);
    }

    /**
     * @Rest\Delete("/sku/{sku}")
     * @Rest\View(statusCode=204)
     *
     * @param string $sku
     */
    public function deleteProductBySku(string $sku): void
    {
        $this->productService->deleteBySku($sku);
    }
}