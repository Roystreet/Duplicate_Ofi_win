<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsersApp;

class TpDocumentIdenties extends Model
{
  use SoftDeletes;

  public    $table = 'tp_document_identies';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_country',
    'description',
    'status'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'           => 'integer',
    'id_country'   => 'integer',
    'description'  => 'string',
    'status'       => 'boolean'
  ];
  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'id_users_app'      => 'required',
    'id_country'   => 'required',
    'description'    => 'required'
  ];
}
