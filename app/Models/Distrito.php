<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\City;

class Distrito extends Model
{
  use SoftDeletes;

  public $table = 'distritos';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_city',
    'distrito',
    'status'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'       => 'integer',
    'id_city'  => 'integer',
    'distrito' => 'string',
    'status'   => 'boolean'
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'id_city'       => 'required',
    'distrito'      => 'required'

  ];

  public function getCity()
  {
    return $this->belongsTo(City::class, 'id_city');
  }
}
