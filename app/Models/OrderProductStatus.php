<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'label',
		'color'
    ];

    /**
     * Get all order products with this status 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products() {
        return $this->hasMany(Product::class);
    }

}
