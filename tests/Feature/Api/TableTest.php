<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error get Tables by Tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenantError()
    {
        $response = $this->getJson('/api/v1/tables');
        $response->assertStatus(422);
    }

    /**
     * Get All Tables by Tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");
        $response->assertStatus(200);
    }

    /**
     * Error Get Table by Tenant
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $table = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");
        $response->assertStatus(404);
    }

    /**
     * Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $table = factory(Table::class)->create();
        $tenant = Tenant::find($table->tenant_id);
        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");
        $response->assertStatus(200);
    }
}
