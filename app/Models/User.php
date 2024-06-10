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
    ];

    public $timestamps = true;
}
