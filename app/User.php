<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\TpSexo;
use App\Models\Country;
use App\Models\Departament;
use App\Models\City;
use App\Models\Distrito;
use App\Models\StatusUsersApp;
use App\Models\TpDocumentIdenties;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_tp_sexo',
        'id_country',
        'id_departament',
        'id_city',
        'id_distrito',
        'id_tp_document_identies',
        'n_document',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'birth',
        'phone',
        'url_photo',
        'email',
        'email_verified_at',
        'password',
        'isexterno',
        'id_status_users_app',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [];


    public function getSexo()
    {
        return $this->belongsTo(TpSexo::class, 'id_tp_sexo');
    }
    public function getCountry()
    {
        return $this->belongsTo(Country::class, 'id_country');
    }
    public function getDepartament()
    {
        return $this->belongsTo(Departament::class, 'id_departament');
    }
    public function getCity()
    {
        return $this->belongsTo(City::class, 'id_city');
    }
    public function getDistritos()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito');
    }
    public function getStatusUsersApp()
    {
        return $this->belongsTo(StatusUsersApp::class, 'id_status_users_app');
    }

    public function getTpDocumentIdenties()
    {
        return $this->belongsTo(TpDocumentIdenties::class, 'id_tp_document_identies');
    }
}
