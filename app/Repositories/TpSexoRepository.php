<?php

namespace App\Repositories;

use App\Models\TpSexo;
use App\Repositories\BaseRepository;

/**
 * Class TpSexoRepository
 * @package App\Repositories
 * @version November 12, 2019, 3:45 pm UTC
*/

class TpSexoRepository extends BaseRepository
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
        return TpSexo::class;
    }
}
