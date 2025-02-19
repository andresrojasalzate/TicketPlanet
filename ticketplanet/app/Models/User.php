<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function sessions(): HasManyThrough
    {
        return $this->hasManyThrough(Session::class, Event::class);
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reset_token',
        'reset_token_created_at',
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
        'password' => 'hashed',
    ];

    public function scopeUserEmail(Builder $query, string $email)
    {
        try {
            return $query->where('email', $email)->first();
        } catch (\Exception $e) {
            Log::error('Error en la función scopeUserEmail en el modelo User', [
                'email' => $email,
                'error_message' => $e->getMessage()
            ]);
        }
    }
}
