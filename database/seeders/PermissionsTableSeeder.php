<?php
namespace Database\Seeders;

use App\Models\Permission;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker::class);
        Permission::create([
            'name' => 'users',
            'description' => $faker->text(50),
        ]);
        Permission::create([
            'name' => 'tenants',
            'description' => $faker->text(50),
        ]);
        Permission::create([
             'name' => 'plans',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'profiles',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'roles',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'permissions',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'categories',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'products',
             'description' => $faker->text(50),
         ]);
         Permission::create([
             'name' => 'tables',
             'description' => $faker->text(50),
         ]);
    }
}
