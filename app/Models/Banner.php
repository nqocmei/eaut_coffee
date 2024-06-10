<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['title', 'image_path', 'position'];

    protected $hidden = [];

    protected $casts = [
        'id' => 'int',
        'title' => 'string',
        'image_path' => 'string',
        'position' => 'integer',
    ];

    protected $dates = [];

    public $timestamps = true;

}
