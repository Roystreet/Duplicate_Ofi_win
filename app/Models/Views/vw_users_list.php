<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class vw_users_list extends Model
{
  protected $table = 'vw_users_list';

  protected $fillable  =
  [
    'id',
    'userid',
    'username',
    'first_name',
    'last_name',
    'middle_name',
    'public_email',
    'phone_base',
    'user_language',
    'public_phone',
    'phone_country',
    'phone_number',
    'document_type',
    'document_number',
    'birth',

    'id_status_users_app',
    'status_users_app',

    'id_country',
    'id_departament',
    'id_city',
    'id_distrito',

    'address_1',
    'country',
    'state_or_province',
    'city',
    'distrito',
    'sponsor_id',

    'id_status_red',
    'status_red',
    'created_at',
    'updated_at',
    'id_users'
  ];



}
