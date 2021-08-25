<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StatusSession;

class StatusSession extends Model
{
    use SoftDeletes;

    public    $table = 'status_sessions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'status_session',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'status_session' => 'string',
        'status'         => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status_session' => 'required'

    ];
    public function getStatusSession()
    {
        return $this->belongsTo(StatusSession::class, 'id_status_sessions');
    }
}
