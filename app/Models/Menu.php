<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'menu',
        'section',
        'path',
        'icon',
        'orden',
        'status_system',
        'status_user',
        'modified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'menu'          => 'string',
        'section'       => 'string',
        'path'          => 'string',
        'icon'          => 'string',
        'orden'         => 'string',
        'status_system' => 'boolean',
        'status_user'   => 'boolean',
        'modified_by'   => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'menu'        => 'required',
        'section'     => 'required',
        'icon'        => 'required',
        // 'path'         => 'required',
        // 'orden'        => 'required',
        // 'modified_by'  => 'required'

    ];
}
