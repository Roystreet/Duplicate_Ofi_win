<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class UsersPasswords extends Model
{
    use SoftDeletes;

    public    $table = 'users_passwords';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_users',
        'password',
        'password_repeat',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'id_users'        => 'integer',
        'password'        => 'string',
        'password_repeat' => 'string',
        'status'          => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_users'        => 'required',
        'password'        => 'required',
        'password_repeat' => 'required',
        'status'          => 'required'
    ];

    public function getUsers()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
