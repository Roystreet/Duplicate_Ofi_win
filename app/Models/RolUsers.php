<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TpRol;
use App\User;

class RolUsers extends Model
{
  use SoftDeletes;

  public    $table = 'rol_users';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_user',
    'id_tp_rol',
    'status'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'           => 'integer',
    'id_user'      => 'integer',
    'id_tp_rol'    => 'integer',
    'status'       => 'boolean'
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'id_user'      => 'required',
    'id_tp_rol'    => 'required'
  ];
  public function getUsers()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
  public function getTpRol()
  {
    return $this->belongsTo(TpRol::class, 'id_tp_rol');
  }
}
