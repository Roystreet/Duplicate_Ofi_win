<?php

namespace App\Repositories;

use App\Models\StatusSession;
use App\Repositories\BaseRepository;

/**
 * Class StatusSessionRepository
 * @package App\Repositories
 * @version December 2, 2019, 2:51 pm UTC
*/

class StatusSessionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status_session',
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
        return StatusSession::class;
    }
}
