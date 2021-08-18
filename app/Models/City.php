<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Departament;

class City extends Model
{
  use SoftDeletes;

  public    $table = 'cities';

  protected $dates = ['deleted_at'];


  public $fillable = [
    'city',
    'id_departament',
    'status'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'             => 'integer',
    'city'           => 'string',
    'id_departament' => 'integer',
    'status'         => 'boolean'
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'city'           => 'required',
    'id_departament' => 'required'
  ];

  public function getDepartament()
  {
    return $this->belongsTo(Departament::class, 'id_departament');
  }
}
