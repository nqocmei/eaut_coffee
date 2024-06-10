<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'configuration';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
    ];

    public function getValueAttribute($value)
    {
        return $this->attributes['value'];
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value;
    }
}
