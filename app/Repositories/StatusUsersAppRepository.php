<?php

namespace App\Repositories;

use App\Models\StatusUsersApp;
use App\Repositories\BaseRepository;

/**
 * Class StatusUsersAppRepository
 * @package App\Repositories
 * @version November 12, 2019, 7:37 pm UTC
*/

class StatusUsersAppRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status_user_offices',
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
        return StatusUsersApp::class;
    }
    public function with($relations)
    {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
    }
}
