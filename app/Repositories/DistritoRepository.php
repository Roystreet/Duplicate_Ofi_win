<?php

namespace App\Repositories;

use App\Models\Distrito;
use App\Repositories\BaseRepository;

/**
 * Class DistritoRepository
 * @package App\Repositories
 * @version February 19, 2020, 3:48 pm UTC
*/

class DistritoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_city',
        'distrito',
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
        return Distrito::class;
    }
}
