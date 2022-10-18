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
         * Roles
         */
        \App\Models\Role::factory(4)->create();

        /**
         * Generate random users accounts
         */
        \App\Models\User::factory(25)->create();

        /**
         * Create admin account
         */
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'email' => 'test@example.com',
            // Default password is 'password'
        ]);

    }
}
