<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StatusRed;
use App\User as Users;

class UsersRed extends Model
{
  use SoftDeletes;

  public $table = 'users_red';

  protected $dates = ['deleted_at'];

  public $fillable = [
    'id_users_sponsor',
    'id_users',
    'username',
    'id_status_red',
    'status'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id'                => 'integer',
    'id_users_sponsor'  => 'integer',
    'id_users' => 'integer',
    'username'          => 'string',
    'id_status_red'     => 'integer',
    'status'            => 'boolean'
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [];

  public function getStatusRed()
  {
    return $this->belongsTo(StatusRed::class, 'id_status_red');
  }

  public function getUsersSponsor()
  {
    return $this->belongsTo(Users::class, 'id_users_sponsor');
  }

  public function getUsersSponsorCodigo()
  {
    return $this->hasOne(UsersRed::class, 'id_users', 'id_users_sponsor');
  }

  public function getUsersInvitado()
  {
    return $this->belongsTo(Users::class, 'id_users');
  }
}
