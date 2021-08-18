<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TpRol;
use App\Models\Menu;

class RolMenu extends Model
{
  use SoftDeletes;

  public    $table = 'rol_menus';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_tp_rol',
    'id_menu',
    'note',
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
    'id_tp_rol'     => 'integer',
    'id_menu'       => 'integer',
    'note'          => 'string',
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
    'id_tp_rol'   => 'required',
    'id_menu'     => 'required',
    // 'modified_by' => 'required'
    // 'note'        => 'required',
  ];

  public function getRol()
  {
    return $this->belongsTo(TpRol::class, 'id_tp_rol');
  }

  public function getMenu()
  {
    return $this->belongsTo(Menu::class, 'id_menu');
  }
}
