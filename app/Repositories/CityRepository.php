<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\BaseRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version November 12, 2019, 7:27 pm UTC
*/

class CityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'city',
        'id_departament',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return City::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }
}
