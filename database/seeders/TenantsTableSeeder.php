<?php
namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj' => '15967828000190',
            'name' => 'NINA E VITOR RESTAURANTE LTDA',
            'url' => 'nina-e-vitor-restaurante-ltda',
            'email' => 'contato@ninaevitorrestauranteltda.com.br'
        ]);
    }
}
