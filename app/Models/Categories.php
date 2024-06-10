<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'is_show_in_nav'
    ];


    protected $hidden = [];

    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'path' => 'string',
        'is_show_in_nav' => 'boolean',
    ];

    protected $dates = [];

    public $timestamps = true;
}
