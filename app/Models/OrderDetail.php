<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_product',
        'id_order',
        'id_user',
        'quantity'
    ];

    protected $hidden = [];

    protected $casts = [
        'id' => 'int',
        'id_product' => 'int',
        'id_order' => 'string',
        'quantity' => 'int',
        'id_user' => 'int',
    ];

    protected $dates = [];

    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
