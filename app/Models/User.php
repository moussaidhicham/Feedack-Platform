<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être affectés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs qui doivent être cachés lors de la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Un utilisateur peut avoir plusieurs feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Un utilisateur peut avoir plusieurs votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin'; // Supposons que vous ayez une colonne `role` pour déterminer si un utilisateur est un admin
    }
}
