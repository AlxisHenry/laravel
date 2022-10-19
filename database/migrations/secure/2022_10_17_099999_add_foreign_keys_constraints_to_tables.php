<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->default(1)
                ->nullable()
                ->constrained('roles')
                ->onDelete('set null');
        });
        Schema::table('users_addresses', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
        Schema::table('users_favorites', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('set null');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('status_id')
                ->default(1)
                ->nullable()
                ->constrained('orders_statuses')
                ->onDelete('set null');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('address_id')
                ->constrained('users_addresses')
                ->onDelete('cascade');
        });
        Schema::table('orders_products', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->onDelete('set null');
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');
            $table->foreignId('status_id')
                ->nullable()
                ->constrained('orders_products_statuses')
                ->onDelete('set null');
        });
    }

};
