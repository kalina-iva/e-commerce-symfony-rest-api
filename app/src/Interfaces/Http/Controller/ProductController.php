<?php

declare(strict_types=1);

namespace App\Interfaces\Http\Controller;

use App\Application\ProductService;
use App\Domain\Product\Entity\Product;
use App\Interfaces\Dto\Product\ProductDto;
use App\Interfaces\Dto\Product\ProductIdResponseDto;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
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
     * @Rest\Get("/page/{page}/limit/{limit}", requirements={"page"="\d+","limit"="\d+"})
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @param int $page
     * @param int $limit
     * @return Product[]
     */
    public function getProducts(int $page, int $limit): array
    {
        return $this->productService->getProducts($page, $limit);
    }

    /**
     * @Rest\Post("")
     * @ParamConverter("dto", converter="fos_rest.request_body")
     * @Rest\View(statusCode=201, serializerGroups={"get_product"})
     *
     * @param ProductDto $dto
     * @param ConstraintViolationListInterface $validationErrors
     * @return ProductIdResponseDto
     */
    public function createProduct(
        ProductDto $dto,
        ConstraintViolationListInterface $validationErrors
    ): ProductIdResponseDto {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors[0]->getMessage());
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
        $product = $this->getProductById($id);
        $this->productService->deleteProduct($product);
    }

    /**
     * @Rest\Delete("/sku/{sku}")
     * @Rest\View(statusCode=204)
     *
     * @param string $sku
     */
    public function deleteProductBySku(string $sku): void
    {
        $product = $this->getProductBySku($sku);
        $this->productService->deleteProduct($product);
    }

    /**
     * @Rest\Get("/{id}", requirements={"id"="\d+"}))
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id): Product
    {
        $product = $this->productService->getById($id);
        if (!$product) {
            throw new BadRequestException("Product not found by id = $id");
        }
        return $product;
    }

    /**
     * @Rest\Get("/sku/{sku}")
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @param string $sku
     * @return Product
     */
    public function getProductBySku(string $sku): Product
    {
        $product = $this->productService->getBySku($sku);
        if (!$product) {
            throw new BadRequestException("Product not found by sku = $sku");
        }
        return $product;
    }

    /**
     * @Rest\Put("/{id}", requirements={"id"="\d+"}))
     * @ParamConverter("dto", converter="fos_rest.request_body")
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @param int $id
     * @param ProductDto $dto
     * @param ConstraintViolationListInterface $validationErrors
     * @return Product
     */
    public function changeProductById(
        int $id,
        ProductDto $dto,
        ConstraintViolationListInterface $validationErrors
    ): Product {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors[0]->getMessage());
        }
        $product = $this->getProductById($id);
        $this->productService->changeProduct(
            $product,
            $dto->getSku(),
            $dto->getName(),
            $dto->getType(),
            $dto->getPrice()
        );
        return $product;
    }

    /**
     * @Rest\Put("/sku/{sku}")
     * @ParamConverter("dto", converter="fos_rest.request_body")
     * @Rest\View(statusCode=200, serializerGroups={"get_product"})
     *
     * @param string $sku
     * @param ProductDto $dto
     * @param ConstraintViolationListInterface $validationErrors
     * @return Product
     */
    public function changeProductBySku(
        string $sku,
        ProductDto $dto,
        ConstraintViolationListInterface $validationErrors
    ): Product {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors[0]->getMessage());
        }
        $product = $this->getProductBySku($sku);
        $this->productService->changeProduct(
            $product,
            $dto->getSku(),
            $dto->getName(),
            $dto->getType(),
            $dto->getPrice()
        );
        return $product;
    }
}