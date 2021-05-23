<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{

    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;


    /**
     * TableService constructor.
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByUuid(string $uuid)
    {
        return $this->productRepository->getProductByUuid($uuid);
    }

}
