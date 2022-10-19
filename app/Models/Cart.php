<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'quantity'
    ];
	
    /**
     * Get the product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user() {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

}
