<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];

    /**
     * Get all products of the order
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Get the user who create this order
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class);
    }

    /**
     * Get the status of the order
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status() {
        return $this->hasOne(ProductStatus::class);
    }

}
