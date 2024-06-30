<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone',
        'avatar',
        'address',
        'id_role',
        'api_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'integer',
        'fullname' => 'string',
        'email' => 'string',
        'password' => 'hashed',
        'phone' => 'string',
        'avatar' => 'string',
        'address' => 'string',
        'id_role' => 'integer',
        'api_token' => 'string',
    ];

    public $timestamps = true;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role() {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }
}
