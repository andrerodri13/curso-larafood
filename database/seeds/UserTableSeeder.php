<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class  UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'André da Silva Rodrigues',
            'email' => 'andrerodri13@hotmail.com',
            'password' => bcrypt('secret')
        ]);
    }
}
