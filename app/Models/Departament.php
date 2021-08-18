<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Country;

class Departament extends Model
{
    use SoftDeletes;

    public    $table = 'departaments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_country',
        'departament',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'id_country'  => 'integer',
        'departament' => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
      'id_country'  => 'required',
      'departament' => 'required',
    ];

    public function getCountry()
    {
      return $this->belongsTo(Country::class,     'id_country');
    }

}
