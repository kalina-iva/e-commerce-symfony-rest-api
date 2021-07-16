<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class ProductController
 * @package App\Controller
 *
 * @Rest\Route("/v1/product")
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     */
    public function getProduct()
    {
        var_dump('hi');
    }
}