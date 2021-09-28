<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\UserTempOvs;

class UpdateUsersAppRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = UserTempOvs::$rules;
        return $rules;
    }
    public function attributes()
    {
      return [
        'id_country'              => 'Pais',
        'id_tp_document_identies' => 'Tipo de Documento',
        'n_document'              => 'N° de documento',
        'first_name'              => 'Primer Nombre',
        'middle_name'             => 'Segundo Nombre',
        'last_name'               => 'Apellidos',
        'phone'                   => 'Teléfono',
        'email'                   => 'E-mail',
        ];
    }
}
