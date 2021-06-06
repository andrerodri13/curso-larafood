<?php
namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Business',
            'url' => 'businers',
            'price' => 499.99,
            'description' => 'Plano Empresarial'
        ]);
        Plan::create([
            'name' => 'Free',
            'url' => 'free',
            'price' => 0.00,
            'description' => 'Plano Free'
        ]);
        Plan::create([
            'name' => 'Premium',
            'url' => 'premium',
            'price' => 299.99,
            'description' => 'Plano Premium'
        ]);
    }
}
