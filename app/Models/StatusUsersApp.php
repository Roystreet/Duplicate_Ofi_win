<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusUsersApp extends Model
{
    use SoftDeletes;

    public    $table = 'status_users_apps';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'status_users_app',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'status_users_app' => 'string',
        'status'           => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status_users_app' => 'required',

    ];
}
