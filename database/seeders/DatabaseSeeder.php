<?php

namespace Database\Seeders;

use App\Models\Privilege;
use App\Models\Role;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        UserType::firstOrCreate([
            'name' => 'ADMINISTRATOR',
            'description' => "Administrateur",
        ]);

        Privilege::firstOrCreate([
            'name' => 'ALL',
            'description' => "Voir un utilisateur",
            'user_type_id' => 1000001,
        ]);

        Role::firstOrCreate([
            'name' => "Superadmin",
            'description' => "Superadmin",
            'active' => true,
            'user_type_id' => 1000001,
        ]);

        User::firstOrCreate([
            'last_name' => 'admin',
            'email' => 'admin@admin.ga',
            'phone' => '074010203',
            'phone_code' => '241',
            'password' => bcrypt('12345678'),
            'user_type_id' => 1000001,
        ]);
    }
}
