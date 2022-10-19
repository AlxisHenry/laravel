<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'slug',
      'description',
      'image',
      'price',
      'quantity',
      'is_visible'
    ];

    /**
     * Get the category of the product
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category() {
        return $this->hasOne(Category::class);
    }

}
