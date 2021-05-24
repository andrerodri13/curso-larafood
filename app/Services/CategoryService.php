<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;


    /**
     * CategoryService constructor.
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {

        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->categoryRepository->getCategoryByUuid($uuid);
    }
}
