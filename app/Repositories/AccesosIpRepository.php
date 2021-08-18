<?php

namespace App\Repositories;

use App\Models\AccesosIp;
use App\Repositories\BaseRepository;

/**
 * Class AccesosIpRepository
 * @package App\Repositories
 * @version February 15, 2020, 3:19 pm UTC
*/

class AccesosIpRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ip',
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
        return AccesosIp::class;
    }
}
