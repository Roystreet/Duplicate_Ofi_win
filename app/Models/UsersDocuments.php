<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class UsersDocuments extends Model
{
  use SoftDeletes;

  public    $table = 'users_documents';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_users',
    'url_photo_front',
    'url_photo_post',
    'status'
  ];


  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'                 => 'integer',
    'id_users'           => 'integer',
    'url_photo_front'    => 'string',
    'url_photo_post'     => 'string',
    'status'             => 'boolean'
  ];


  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'id_users' => 'required',
    'url_photo_front'    => 'required',
    'url_photo_post'    => 'required'
  ];

  public function getUsers()
  {
    return $this->belongsTo(Users::class, 'id_users');
  }
}
