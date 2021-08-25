<?php

namespace App\Repositories;

use App\Models\Session;
use App\Repositories\BaseRepository;

/**
 * Class SessionRepository
 * @package App\Repositories
 * @version December 2, 2019, 3:17 pm UTC
*/

class SessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'token',
        'd_inicio',
        'h_inicio',
        'd_fin',
        'h_fin',
        'ip',
        'navegador',
        'id_status_session'
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
        return Session::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
