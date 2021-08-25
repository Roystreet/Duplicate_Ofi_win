<?php

namespace App\Repositories;

use App\Models\PasswordUsersApp;
use App\Repositories\BaseRepository;

/**
 * Class PasswordUsersAppRepository
 * @package App\Repositories
 * @version November 28, 2019, 7:06 pm UTC
*/

class PasswordUsersAppRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_users_app',
        'password',
        'password_repeat',
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
        return PasswordUsersApp::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
