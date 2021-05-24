<?php


namespace App\Repositories\Contracts;


interface TableRepositoryInterface
{
    public function getTableByTenantUuid(string $uuid);

    public function getTablesByTenantId(int $idTenant);

    public function getTableByUuid(string $uuid);
}
