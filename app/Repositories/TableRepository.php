<?php


namespace App\Repositories;


use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    private $table;

    /**
     * TableRepository constructor.
     */
    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTableByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('uuid', $uuid)
            ->select('tables.*')
            ->get();
    }

    public function getTablesByTenantId(int $idTenant)
    {
        return DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->get();
    }

    public function getTableByUuid(string $uuid)
    {
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();
    }
}
