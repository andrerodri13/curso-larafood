<?php

namespace App\Observers;

use App\Models\Tenant;

class TenantObserver
{

    /**
     * @param Tenant $tenant
     */
    public function creating(Tenant $tenant)
    {
        $tenant->uuid = \Str::uuid();
        $tenant->url = \Str::slug($tenant->name, '-');
    }


    /**
     * @param Tenant $tenant
     */
    public function updating(Tenant $tenant)
    {
        $tenant->url = \Str::slug($tenant->name, '-');
    }


}
