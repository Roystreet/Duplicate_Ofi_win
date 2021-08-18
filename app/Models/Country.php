<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    public    $table = 'countries';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'country',
        'code_country',
        'code_phone',
        'moneda_local',
        'moneda_admitida',
        'simbolo_local',
        'simbolo_admitida',
        'conversion_monto',
        'url_image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'country' => 'string',
        'code_country' => 'string',
        'code_phone' => 'string',
        'moneda_local' => 'string',
        'moneda_admitida' => 'string',
        'simbolo_local' => 'string',
        'simbolo_admitida' => 'string',
        'conversion_monto' => 'string',
        'url_image' => 'string',
        'status'  => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'country' => 'required',
    ];
}
