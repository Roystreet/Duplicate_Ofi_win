<?php

namespace App\Repositories;

use App\Models\Departament;
use App\Repositories\BaseRepository;
/**
 * Class DepartamentRepository
 * @package App\Repositories
 * @version November 12, 2019, 7:09 pm UTC
*/

class DepartamentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_country',
        'departament',
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
        return Departament::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }
}
