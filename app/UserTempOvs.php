<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
use App\Models\Country;
use App\Models\TpDocumentIdenties;


class UserTempOvs extends Authenticatable
{
    use Notifiable;
    public    $table = 'users_temp_ovs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_country',
        'id_tp_document_identies',
        'n_document',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'email',
        'id_user_modify',
        'status_ov',
    ];

    public function getUserModify()
    {
        return $this->belongsTo(User::class, 'id_user_modify');
    }
    public function getCountry()
    {
        return $this->belongsTo(Country::class, 'id_country');
    }
    public function getTpDocumentIdenties()
    {
        return $this->belongsTo(TpDocumentIdenties::class, 'id_tp_document_identies');
    }

}
