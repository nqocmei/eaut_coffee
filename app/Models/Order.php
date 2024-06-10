<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recipient',
        'order_date',
        'delivery_date',
        'total_funds',
        'payment_methods',
        'delivery_address',
        'pickup_phone',
        'status',
        'id_user'
    ];

    protected $casts = [
        'recipient' => 'string',
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'total_funds' => 'int',
        'payment_methods' => 'integer',
        'delivery_address' => 'string',
        'status' => 'int',
        'pickup_phone' => 'string',
        'id_user' => 'int',
    ];

    protected $dates = [
        'order_date',
        'delivery_date'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = \Str::uuid();
        });
    }

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
