<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'birthday',
        'phone',
        'email',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
	 * Get all addresses owned by the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function user() {
		return $this->hasMany(UserAddress::class);
	}

    /**
	 * Get the role of the current user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */ 
    public function role() {
        return $this->belongsTo(UserRole::class);
    }

    /**
	 * Get all product in the user cart
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */ 
    public function cart() {
        return $this->hasMany(Cart::class);
    }

    /**
	 * Get all favorites of the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */ 
    public function favorites() {
        return $this->hasMany(UserFavorite::class);
    }
}
