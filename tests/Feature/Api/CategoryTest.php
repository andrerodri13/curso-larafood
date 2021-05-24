<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error get Categories by Tenant
     *
     * @return void
     */
    public function testGetAllCategoriesByTenantError()
    {
        $response = $this->getJson('/api/v1/categories');
        $response->assertStatus(422);
    }

    /**
     * Get All Categories by Tenant
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");
        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");
        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = factory(Category::class)->create();
        $tenant = Tenant::find($category->tenant_id);
        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");
        $response->assertStatus(200);
    }
}
