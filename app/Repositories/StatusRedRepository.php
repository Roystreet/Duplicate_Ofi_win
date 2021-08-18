<?php

namespace App\Repositories;

use App\Models\StatusRed;
use App\Repositories\BaseRepository;

/**
 * Class StatusRedRepository
 * @package App\Repositories
 * @version January 27, 2020, 1:42 pm UTC
*/

class StatusRedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
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
        return StatusRed::class;
    }
}
