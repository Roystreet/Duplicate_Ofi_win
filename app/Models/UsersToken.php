<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TpToken;

class UsersToken extends Model
{
    use SoftDeletes;

    public    $table = 'users_token';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_tp_token',
        'token_llave',
        'token_code',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'id_tp_token' => 'integer',
        'token_llave' => 'string',
        'token_code'  => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_tp_token' => 'required',
        'token_llave' => 'required|email',
        'token_code'  => 'required|string',
        'status'      => 'required'
    ];

    public function getTpToken()
    {
        return $this->belongsTo(TpToken::class, 'id_tp_token');
    }
}
