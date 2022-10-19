<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** 
         * Create roles
         */
        \App\Models\Role::factory()->create([
            'label' => 'user',
        ]);

        \App\Models\Role::factory()->create([
            'label' => 'vip',
        ]);

        \App\Models\Role::factory()->create([
            'label' => 'admin',
        ]);

        /**
         * Generate random users accounts
         */
        \App\Models\User::factory(50)->create();

        /**
         * Create admin account
         */
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'email' => '    ',
            // Default password is 'password'
        ]);

        /**
         * Generate random categories
         */
        \App\Models\Category::factory(10)->create();

    }
}
