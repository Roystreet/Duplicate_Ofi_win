<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccesosIp extends Model
{
    use SoftDeletes;

    public $table = 'accesos_ips';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ip',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ip' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'ip' => 'required',

    ];
}
