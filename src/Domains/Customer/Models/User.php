<?php

namespace Domains\Customer\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Domains\Customer\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuid;
    use Notifiable;
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'uuid', // 'uuid' is not in the migration, but we need it for the 'HasApiTokens' trait
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'billing_id',
        'shipping_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function billing(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'billing_id');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_id');
    }

    protected $casts = [
        'password' => 'hashed',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
