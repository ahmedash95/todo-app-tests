<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function social()
    {
        return $this->hasMany(Social::class);
    }

    public function token($platform)
    {
        return $this->social()->where('platform', $platform)->first();
    }

    public function hasToken($platform) : bool
    {
        return $this->social()->where('platform', $platform)->exists();
    }
}
