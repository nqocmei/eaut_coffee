<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'image_path',
        'price',
        'description',
        'discount',
        'promotional_price',
        'amount',
        'id_category'
    ];

    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'image_path' => 'string',
        'price' => 'int',
        'description' => 'string',
        'discount' => 'int',
        'promotional_price' => 'int',
        'amount' => 'int',
        'id_category' => 'int'
    ];

    public $timestamps = true;


    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id_category');
    }
}
