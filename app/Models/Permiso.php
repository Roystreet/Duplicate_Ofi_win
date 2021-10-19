<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permiso;
use App\User;

class Permiso extends Model
{
  use SoftDeletes;

  public    $table = 'permisos';

  protected $dates = ['deleted_at'];



  public $fillable = [
    'permiso',
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
    'permiso'       => 'string',
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
    'permiso'     => 'required',
    'modified_by' => 'required'

  ];

  public function getUsers()
  {
    return $this->belongsTo(User::class, 'modified_by');
  }

  public function getPermisos()
  {
    return $this->belongsTo(Permiso::class, 'id_permisos');
  }
}
