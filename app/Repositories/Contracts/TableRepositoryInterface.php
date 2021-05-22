<?php


namespace App\Repositories\Contracts;


interface TableRepositoryInterface
{
    public function  getTableByTenantUuid(string $uuid);
    public function  getTableByTenantId(int $idTenant);
    public function getTableByIdentify(string $identify);
}
