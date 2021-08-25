<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TpRol extends Model
{
    use SoftDeletes;

    public    $table = 'tp_rols';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'descripcion',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'descripcion' => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',

    ];
}
