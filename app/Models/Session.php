<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StatusSession;
use App\Models\Session;

class Session extends Model
{
    use SoftDeletes;

    public    $table = 'sessions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'token',
        'd_inicio',
        'h_inicio',
        'd_fin',
        'h_fin',
        'ip',
        'navegador',
        'id_status_session'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'token'             => 'string',
        'd_inicio'          => 'date',
        'd_fin'             => 'date',
        'ip'                => 'text',
        'navegador'         => 'text',
        'id_status_session' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'token'             => 'required',
        'd_inicio'          => 'required',
        'h_inicio'          => 'required',
        'd_fin'             => 'required',
        'h_fin'             => 'required',
        'id_status_session' => 'required'

    ];

    public function getStatusSession()
    {
        return $this->belongsTo(StatusSession::class, 'id_status_session');
    }
    public function getSession()
    {
        return $this->belongsTo(Session::class, 'id_sessions');
    }
}
