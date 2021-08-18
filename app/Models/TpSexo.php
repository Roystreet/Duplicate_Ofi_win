<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsersApp;

class TpSexo extends Model
{
    use SoftDeletes;

    public    $table = 'tp_sexos';

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
    public function getSexo()
    {
        return $this->hasMany(Users::class, 'id');
    }
}
