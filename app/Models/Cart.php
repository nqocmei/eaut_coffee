<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_product',
        'id_user',
        'quantity'
    ];

    protected $casts = [
        'id' => 'int',
        'id_product' => 'int',
        'id_user' => 'int',
        'quantity' => 'int'
    ];

    protected $dates = [];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
