<?php

namespace App\Repositories;

use App\Models\PhotoPerfil;
use App\Repositories\BaseRepository;

/**
 * Class PhotoPerfilRepository
 * @package App\Repositories
 * @version December 6, 2019, 1:20 pm UTC
*/

class PhotoPerfilRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_users_app',
        'url_photo',
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
        return PhotoPerfil::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
