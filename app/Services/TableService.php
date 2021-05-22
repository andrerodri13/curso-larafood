<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TableRepository;

class TableService
{
    /**
     * @var TableRepository
     */
    private $tableRepository;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;


    /**
     * TableService constructor.
     */
    public function __construct(
        TableRepositoryInterface $tableRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTableByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->tableRepository->getTableByTenantId($tenant->id);
    }

    public function getTableByIdentify(string $identify)
    {
        return $this->tableRepository->getTableByIdentify($identify);
    }
}
