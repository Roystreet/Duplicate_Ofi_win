<?php

namespace App\Repositories;

use App\Models\RedUsuarios;
use App\Repositories\BaseRepository;

/**
 * Class RedUsuariosRepository
 * @package App\Repositories
 * @version January 27, 2020, 9:02 pm UTC
*/

class RedUsuariosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_users_sponsor',
        'id_users_invitado',
        'codigo_invitado',
        'usuario_invitado',
        'id_status_red',
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
        return RedUsuarios::class;
    }

    public function with($relations) {
           if (is_string($relations)) $relations = func_get_args();

           $this->with = $relations;

           return $this;
       }

  }
