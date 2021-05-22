<?php


namespace App\Repositories\Contracts;


interface TenantRepositoryInterface
{
    public function  getAllTenants(int $perPage);
    public function  getTenantByUuid(string $uuid);
}
