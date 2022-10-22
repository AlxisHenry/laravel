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
         * Generate roles
         */
        $roles = ['admin', 'user', 'view', 'vip'];

        foreach ($roles as $role) {
            \App\Models\Role::factory()->create([
                'label' => $role,
            ]);
        }

        /**
         * Generate random users accounts
         */
        \App\Models\User::factory(250)->create();

        /**
         * Generate accounts
         */
        $accounts = json_encode([
            [ 'username' => 'admin', 'email' => 'admin@example.com' ],
            [ 'username' => 'user', 'email' => 'test2@example.com' ],
            [ 'username' => 'Joe', 'email' => 'test3@example.com']
        ]);

        foreach (json_decode($accounts) as $account) {
            \App\Models\User::factory()->create([
                'username' => $account->username,
                'email' => $account->email,
                'role_id' => random_int(1, count($roles) - 1),
                // Default password is 'password'
            ]);
        }

        /**
         * Generate random categories
         */
        \App\Models\Category::factory(24)->create();

        /**
         * Generate differents statuses
         */
        \App\Models\OrderProductStatus::factory(7)->create();
        \App\Models\OrderStatus::factory(7)->create();

        /**
         * Generate random products
         */
        \App\Models\Product::factory(350)->create();

    }
}
