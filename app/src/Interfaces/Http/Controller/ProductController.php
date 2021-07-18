<?php

declare(strict_types=1);

namespace App\Interfaces\Http\Controller;

use App\Application\ProductService;
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
     * @Rest\Get("")
     */
    public function getProduct(): array
    {
        return $this->productService->getProduct();
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
}